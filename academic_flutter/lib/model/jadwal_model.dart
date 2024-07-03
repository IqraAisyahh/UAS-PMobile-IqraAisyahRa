class Jadwal {
  final int idJadwal;
  final int idKelas;
  final String hari;
  final String jamMasuk;
  final String jamKeluar;
  final String semester;
  final String namaMapel;

  Jadwal({
    required this.idJadwal,
    required this.idKelas,
    required this.hari,
    required this.jamMasuk,
    required this.jamKeluar,
    required this.semester,
    required this.namaMapel,
  });

  factory Jadwal.fromJson(Map<String, dynamic> json) {
    return Jadwal(
      idJadwal: json['id_jadwal'],
      idKelas: json['id_kelas'],
      hari: json['hari'],
      jamMasuk: json['jam_masuk'],
      jamKeluar: json['jam_keluar'],
      semester: json['semester'],
      namaMapel: json['mapel']['nama_mapel'], // Memperhatikan struktur mapel
    );
  }
}
