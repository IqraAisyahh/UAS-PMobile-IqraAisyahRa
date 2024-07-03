import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class ApiService {
  static const String baseUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api'; // Update base URL
  static const _storage = FlutterSecureStorage();

  static Future<Map<String, dynamic>> login(String email, String password) async {
    try {
      final url = Uri.parse('$baseUrl/login');
      final response = await http.post(
        url,
        headers: <String, String>{
          'Content-Type': 'application/json; charset=UTF-8',
        },
        body: jsonEncode(<String, String>{
          'email': email,
          'password': password,
        }),
      );

      if (response.statusCode == 200) {
        final responseData = jsonDecode(response.body) as Map<String, dynamic>;
        print('Response data: $responseData'); // Debugging statement

        if (responseData['status'] == true) {
          final user = responseData['data'] as Map<String, dynamic>;
          final token = responseData['token'] as Map<String, dynamic>;

          // Handle roles array
          final roles = List<Map<String, dynamic>>.from(user['roles']);

          // Save token in storage
          await _storage.write(key: 'token', value: token['name']);

          // Save roles in storage (optional)
          await _storage.write(key: 'roles', value: jsonEncode(roles));

          return {'status': true, 'message': 'Login berhasil', 'user': user};
        } else {
          return {'status': false, 'message': responseData['message']};
        }
      } else {
        print('Response status code: ${response.statusCode}'); // Debugging statement
        print('Response body: ${response.body}'); // Debugging statement
        return {'status': false, 'message': 'Login failed'};
      }
    } catch (e) {
      print('Exception during login: $e'); // Debugging statement
      return {'status': false, 'message': 'Exception during login: $e'};
    }
  }
}
