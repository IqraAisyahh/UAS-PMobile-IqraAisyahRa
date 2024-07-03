bool validateEmailAddress(String email) {
  // Regular expression for validating an email address
  const String emailPattern =
      r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$';
  final RegExp regex = RegExp(emailPattern);
  return regex.hasMatch(email);
}

bool validatePassword(String password) {
  // Minimum eight characters, at least one letter and one number
  const String passwordPattern =
      r'^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$';
  final RegExp regex = RegExp(passwordPattern);
  return regex.hasMatch(password);
}
