"""
Notes
    This script should be run with administrative privileges to ensure that it can modify
        system environment variables.
    The script assumes that your Java versions are installed in "C:\\Program Files\\Java".
        Adjust the java_base_path if your Java installations are located elsewhere.
    It updates both the local os.environ for the session where the script runs and the
        global environment variables via setx, which affects all future command shells
        (but not existing ones).

"""
import os
import sys
import subprocess

# Path where your Java versions are installed
java_base_path = "C:\\Program Files\\Java"

def list_java_versions():
    """List available Java versions installed in the java_base_path."""
    try:
        versions = [d for d in os.listdir(java_base_path) if os.path.isdir(os.path.join(java_base_path, d))]
        return versions
    except FileNotFoundError:
        print("Java installation directory not found.")
        return []

def set_java_version(version):
    """Set the selected Java version by updating JAVA_HOME and Path."""
    java_path = os.path.join(java_base_path, version)
    bin_path = os.path.join(java_path, 'bin')

    # Setting JAVA_HOME
    os.environ['JAVA_HOME'] = java_path

    # Updating Path environment variable
    path_env = os.environ['Path'].split(';')
    path_env = [p for p in path_env if 'Java\\jdk' not in p]  # Remove old Java bin paths
    path_env.append(bin_path)  # Add new Java bin path
    os.environ['Path'] = ';'.join(path_env)

    # Apply changes to the system environment variables (requires administrative privileges)
    subprocess.run(['setx', 'JAVA_HOME', java_path], check=True)
    subprocess.run(['setx', 'Path', ';'.join(path_env)], check=True)

    print(f"Java version set to {version} successfully.")

def main():
    versions = list_java_versions()
    if not versions:
        return

    print("Available Java versions:")
    for i, version in enumerate(versions):
        print(f"{i+1}. {version}")

    try:
        choice = int(input("Select the Java version to switch to (number): ")) - 1
        if choice < 0 or choice >= len(versions):
            raise ValueError
        set_java_version(versions[choice])
    except ValueError:
        print("Invalid selection. Please enter a valid number.")
    except subprocess.CalledProcessError:
        print("Failed to set environment variables. Please run as administrator.")

if __name__ == "__main__":
    main()
