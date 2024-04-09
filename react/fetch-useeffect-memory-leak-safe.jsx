import React, { useState, useEffect } from "react";
import axios from "axios";

import Constants from "expo-constants";

const baseUrl = "https://reqres.in";

function User({ userObject }) {
  return (
    <div>
      <img
        src={{ uri: userObject.avatar }}
        style={{ width: 200, height: 200, borderRadius: 100 }}
      />
      <p style={{ textAlign: "center", fontSize: 20 }}>
        {`${userObject.first_name} ${userObject.last_name}`}
      </p>
    </div>
  );
}

export default function TestApi() {
  const [userId, setUserId] = useState(1);
  const [user, setUser] = useState(null);
  const [isLoading, setIsLoading] = useState(false);
  const [hasError, setErrorFlag] = useState(false);

  const changeUserIdHandler = () => {
    setUserId((userId) => (userId === 3 ? 1 : userId + 1));
  };

  useEffect(() => {
    const abortController = new AbortController();
    const url = `${baseUrl}/api/users/${userId}`;

    const fetchUsers = async () => {
      try {
        setIsLoading(true);

        const response = await axios.get(url, {
          signal: abortController.signal,
        });

        if (response.status === 200) {
          setUser(response.data.data);
          setIsLoading(false);
          console.log(response);
          return;
        } else {
          throw new Error("Failed to fetch users");
        }
      } catch (error) {
        if (abortController.signal.aborted) {
          console.log("Data fetching cancelled");
        } else {
          setErrorFlag(true);
          setIsLoading(false);
        }
      }
    };

    fetchUsers();

    return () => abortController.abort("Data fetching cancelled");
  }, [userId]);

  return (
    <div style={styles.container}>
      <div style={styles.wrapperStyle}>
        {!isLoading && !hasError && user && <User userObject={user} />}
      </div>
      <div style={styles.wrapperStyle}>
        {isLoading && <Text> Loading </Text>}
        {!isLoading && hasError && <Text> An error has occurred </Text>}
      </div>
      <div>
        <button
          onPress={changeUserIdHandler}
          disabled={isLoading}
          style={styles.buttonStyles}
        >
          <Text style={styles.textStyles}>Get New User</Text>
        </button>
      </div>
    </div>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "white",
    alignItems: "center",
    justifyContent: "center",
    marginTop: Platform.OS === "ios" ? 0 : Constants.statusBarHeight,
  },
  wrapperStyle: {
    minHeight: 128,
  },
  buttonStyles: {
    backgroundColor: "dodgerblue",
  },
  textStyles: {
    fontSize: 20,
    color: "white",
    padding: 10,
  },
});
