function isHeldToggle(id) {
  setObj((prevObj) => {
    return prevObj.map((obj) => {
      return obj.id === id ? { ...obj, isHeld: !obj.isHeld } : obj;
    });
  });
}
