import 'package:http/http.dart' as http;
import 'dart:convert';

class ClassService {
  Future<List<dynamic>> fetchKelasList() async {
    String apiUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api/kelas';

    try {
      final response = await http.get(Uri.parse(apiUrl));

      if (response.statusCode == 200) {
        return jsonDecode(response.body);
      } else {
        throw Exception('Failed to load data');
      }
    } catch (e) {
      print('Error fetching data: $e');
      throw e;
    }
  }

  Future<List<dynamic>> fetchSiswa(String idKelas) async {
    String apiUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api/kelas/$idKelas';

    try {
      final response = await http.get(Uri.parse(apiUrl));

      if (response.statusCode == 200) {
        var responseData = jsonDecode(response.body);
        return responseData['siswas'];
      } else {
        throw Exception('Failed to load data');
      }
    } catch (e) {
      print('Error fetching data: $e');
      throw e;
    }
  }
}
