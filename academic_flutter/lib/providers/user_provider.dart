// lib/providers/user_provider.dart

import 'package:flutter/material.dart';
import 'package:academic_flutter/model/user_model.dart';

class UserProvider with ChangeNotifier {
  User _user = User(
    name: 'Default User',
    email: 'user@example.com',
    profileImage: 'assets/images/default_profile_image.jpg',
  );

  User get user => _user;

  void setUser(User user) {
    _user = user;
    notifyListeners();
  }
}
