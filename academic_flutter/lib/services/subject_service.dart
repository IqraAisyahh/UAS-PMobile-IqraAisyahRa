import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:academic_flutter/model/mapel_model.dart';

class ApiService {
  static const String apiUrl = 'https://0f63-125-165-105-222.ngrok-free.app/api/mapel';

  Future<List<MataPelajaran>> getMataPelajaran() async {
    final response = await http.get(Uri.parse(apiUrl));

    if (response.statusCode == 200) {
      List jsonResponse = json.decode(response.body);
      return jsonResponse.map((data) => MataPelajaran.fromJson(data)).toList();
    } else {
      throw Exception('Failed to load data');
    }
  }
}
