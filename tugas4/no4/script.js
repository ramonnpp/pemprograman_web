const number = 100, text = 'a';

try {
  console.log(number / text); 
  console.log(a); 
}
catch (err) {
  console.log("An error caught");
  console.log("Error message: " + err);
}
finally {
  console.log("Finally will execute every time");
}