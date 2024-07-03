class Siswa {
  final int nis;
  final String namaSiswa;
  final String tempatLahir;
  final String tanggalLahir;
  final String jenisKelamin;
  final String agama;
  final String alamat;
  final String noTelp;
  final int idKelas;
  final DateTime createdAt;
  final DateTime updatedAt;

  Siswa({
    required this.nis,
    required this.namaSiswa,
    required this.tempatLahir,
    required this.tanggalLahir,
    required this.jenisKelamin,
    required this.agama,
    required this.alamat,
    required this.noTelp,
    required this.idKelas,
    required this.createdAt,
    required this.updatedAt,
  });

  factory Siswa.fromJson(Map<String, dynamic> json) {
    return Siswa(
      nis: json['nis'],
      namaSiswa: json['nama_siswa'],
      tempatLahir: json['tempat_lahir'],
      tanggalLahir: json['tanggal_lahir'],
      jenisKelamin: json['jenis_kelamin'],
      agama: json['agama'],
      alamat: json['alamat'],
      noTelp: json['no_telp'],
      idKelas: json['id_kelas'],
      createdAt: DateTime.parse(json['created_at']),
      updatedAt: DateTime.parse(json['updated_at']),
    );
  }
}
