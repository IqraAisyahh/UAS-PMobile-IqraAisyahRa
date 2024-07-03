class Nilai {
  final int idNilai;
  final String nis;
  final String namaSiswa;
  final String nip;
  final int idMapel;
  final String namaMapel;
  final String tahunAjaran;
  final int semester;
  final double nilaiUH;
  final double nilaiUTS;
  final double nilaiUAS;
  final double nilaiPraktek;
  final double totalNilai;
  final String predikat;

  Nilai({
    required this.idNilai,
    required this.nis,
    required this.namaSiswa,
    required this.nip,
    required this.idMapel,
    required this.namaMapel,
    required this.tahunAjaran,
    required this.semester,
    required this.nilaiUH,
    required this.nilaiUTS,
    required this.nilaiUAS,
    required this.nilaiPraktek,
    required this.totalNilai,
    required this.predikat,
  });

  factory Nilai.fromJson(Map<String, dynamic> json) {
    // Function to compute total nilai from JSON data
    double computeTotalNilai(Map<String, dynamic> json) {
      return (json['nilai_uh'] ?? 0).toDouble() +
             (json['nilai_uts'] ?? 0).toDouble() +
             (json['nilai_uas'] ?? 0).toDouble() +
             (json['nilai_praktek'] ?? 0).toDouble();
    }

    return Nilai(
      idNilai: json['id_nilai'] ?? 0,
      nis: json['nis'].toString(),
      namaSiswa: json['siswa']?['nama_siswa'] ?? '',
      nip: json['nip'].toString(),
      idMapel: json['id_mapel'] ?? 0,
      namaMapel: json['mapel']?['nama_mapel'] ?? '',
      tahunAjaran: json['tahun_ajaran'] ?? '',
      semester: int.tryParse(json['semester'].toString()) ?? 0,
      nilaiUH: (json['nilai_uh'] ?? 0).toDouble(),
      nilaiUTS: (json['nilai_uts'] ?? 0).toDouble(),
      nilaiUAS: (json['nilai_uas'] ?? 0).toDouble(),
      nilaiPraktek: (json['nilai_praktek'] ?? 0).toDouble(),
      totalNilai: computeTotalNilai(json), // Calculate total nilai
      predikat: json['predikat'] ?? '',
    );
  }
}
