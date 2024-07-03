import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:academic_flutter/model/guru_model.dart';

class GuruService {
  static const String apiUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api/guru'; // Sesuaikan dengan URL API Laravel Anda

  Future<List<Guru>> getGurus() async {
    try {
      final response = await http.get(Uri.parse(apiUrl));

      if (response.statusCode == 200) {
        List<dynamic> data = jsonDecode(response.body);
        List<Guru> Gurus = data.map((item) => Guru.fromJson(item)).toList();
        return Gurus;
      } else {
        throw Exception('Failed to load Gurus');
      }
    } catch (e) {
      throw Exception('Error: $e');
    }
  }
}
