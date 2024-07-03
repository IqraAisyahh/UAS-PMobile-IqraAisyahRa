import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'nis_input_screen.dart';
import 'student_detail_screen.dart';
import 'package:academic_flutter/widgets/bottom_nav_bar.dart';

class ProfileScreen extends StatefulWidget {
  @override
  _ProfileScreenState createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  String _userEmail = '';
  String _userName = '';
  String _nis = '';
  bool isDarkMode = false;
  int _currentIndex = 2;
  bool isNISInputted = false;
  int? idUser;

  @override
  void initState() {
    super.initState();
    _loadUserId();
  }

  Future<void> _loadUserId() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      idUser = prefs.getInt('userId');
    });
    if (idUser != null) {
      fetchUserData();
    }
  }

  void fetchUserData() async {
    if (idUser == null) return;

    try {
      final response =
          await http.get(Uri.parse('https://0f63-125-165-105-222.ngrok-free.app/api/user/$idUser'));
      print('Response status code: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        print('Decoded data: $data');

        if (data != null && data['user'] != null) {
          final userData = data['user'];

          if (userData['name'] != null && userData['email'] != null) {
            setState(() {
              _userName = userData['name'];
              _userEmail = userData['email'];
            });
          } else {
            print('User data fields (name or email) are null or missing.');
          }
        } else {
          print('User data or user object is null.');
        }
      } else {
        print('Failed to load user data: ${response.statusCode}');
      }
    } catch (e) {
      print('Error fetching user data: $e');
    }
  }

  void _onBottomNavTapped(int index) {
    setState(() {
      _currentIndex = index;
    });

    switch (index) {
      case 0:
        Navigator.of(context).pushReplacementNamed('/home');
        break;
      case 1:
        Navigator.of(context).pushReplacementNamed('/schedule');
        break;
      case 2:
        break;
      case 3:
        Navigator.of(context).pushReplacementNamed('/grades');
        break;
      default:
        break;
    }
  }

  void showLogoutDialog() {
    showDialog(
      context: context,
      builder: (context) {
        return AlertDialog(
          title: Text("Logout"),
          content: Text("Are you sure you want to logout?"),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.pop(context);
              },
              child: Text("Cancel"),
            ),
            TextButton(
              onPressed: () {
                Navigator.pop(context);
                Navigator.pushReplacementNamed(context, '/');
              },
              child: Text(
                "Logout",
                style: TextStyle(color: Colors.red),
              ),
            ),
          ],
        );
      },
    );
  }

  Widget languageOption(String language) {
    return ListTile(
      title: Text(language),
      onTap: () {
        print("Selected language: $language");
        Navigator.pop(context);
      },
    );
  }

  void _viewStudentDetails() {
  if (isNISInputted) {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => StudentDetailsScreen(nis: _nis),
      ),
    );
  } else {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text('Input NIS first'),
        duration: Duration(seconds: 2),
      ),
    );
  }
}

void _navigateToNISInput() async {
  final result = await Navigator.push(
    context,
    MaterialPageRoute(builder: (context) => NISInputScreen()),
  );

  if (result != null && result is String) {
    setState(() {
      _nis = result; // Save NIS
      isNISInputted = true;
    });

    // Save NIS to SharedPreferences
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setString('nis', _nis);
  }
}



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        backgroundColor: Colors.white,
        automaticallyImplyLeading: false,
        title: const Text(
          "Profile",
          style: TextStyle(
            color: Colors.black,
            fontWeight: FontWeight.w500,
            fontSize: 16,
          ),
        ),
        centerTitle: false,
      ),
      body: buildBody(),
      bottomNavigationBar: BottomNavBar(
        currentIndex: _currentIndex,
        onTap: _onBottomNavTapped,
      ),
    );
  }

  SingleChildScrollView buildBody() {
    return SingleChildScrollView(
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 30),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            SizedBox(
              width: double.infinity,
              child: Row(
                children: [
                  Container(
                    height: 70,
                    width: 70,
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      color: Colors.grey.shade200,
                      border: Border.all(
                        color: Colors.grey.shade400,
                        width: 1,
                      ),
                    ),
                    child: Icon(Icons.person, size: 40),
                  ),
                  SizedBox(width: 16),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        _userName.isNotEmpty ? _userName : 'Loading...',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: 14,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                      SizedBox(height: 8),
                      Text(
                        _userEmail.isNotEmpty ? _userEmail : 'Loading...',
                        style: TextStyle(
                          color: Colors.black,
                          fontSize: 12,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            SizedBox(height: 32),
            ListTile(
              contentPadding: EdgeInsets.symmetric(horizontal: 0),
              leading: Icon(Icons.person, color: Colors.black),
              title: Text('Student Details'),
              onTap: _viewStudentDetails,
            ),
            Divider(color: Colors.grey.shade300),
            ListTile(
              contentPadding: EdgeInsets.symmetric(horizontal: 0),
              leading: Icon(Icons.edit, color: Colors.black),
              title: Text('Input NIS'),
              onTap: _navigateToNISInput,
            ),
            Divider(color: Colors.grey.shade300),
            ListTile(
              contentPadding: EdgeInsets.symmetric(horizontal: 0),
              leading: Icon(Icons.language, color: Colors.black),
              title: Text('Language'),
              onTap: () {
                showModalBottomSheet(
                  context: context,
                  builder: (BuildContext context) {
                    return Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        languageOption("English"),
                        languageOption("Indonesia"),
                      ],
                    );
                  },
                );
              },
            ),
            Divider(color: Colors.grey.shade300),
            ListTile(
              contentPadding: EdgeInsets.symmetric(horizontal: 0),
              leading: Icon(Icons.brightness_6, color: Colors.black),
              title: Text('Theme'),
              trailing: Switch(
                value: isDarkMode,
                onChanged: (value) {
                  setState(() {
                    isDarkMode = value;
                  });
                },
              ),
            ),
            Divider(color: Colors.grey.shade300),
            ListTile(
              contentPadding: EdgeInsets.symmetric(horizontal: 0),
              leading: Icon(Icons.exit_to_app, color: Colors.black),
              title: Text('Logout'),
              onTap: showLogoutDialog,
            ),
          ],
        ),
      ),
    );
  }
}
