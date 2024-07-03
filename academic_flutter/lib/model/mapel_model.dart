class MataPelajaran {
  final int id;
  final String namaMapel;
  final String namaGuru;
  final int? nip;

  MataPelajaran({
    required this.id,
    required this.namaMapel,
    required this.namaGuru,
    this.nip,
  });

  factory MataPelajaran.fromJson(Map<String, dynamic> json) {
    return MataPelajaran(
      id: json['id_mapel'],
      namaMapel: json['nama_mapel'],
      namaGuru: json['guru']['nama_guru'],
      nip: json['nip'] != null ? json['nip'] : null,
    );
  }
}
