import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:academic_flutter/model/siswa_model.dart';

class SiswaService {
  final String baseUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api';

  Future<Siswa> fetchSiswa(String nis) async {
    final response = await http.get(Uri.parse('$baseUrl/siswa/$nis'));

    if (response.statusCode == 200) {
      return Siswa.fromJson(json.decode(response.body));
    } else {
      throw Exception('Failed to load siswa');
    }
  }
}
