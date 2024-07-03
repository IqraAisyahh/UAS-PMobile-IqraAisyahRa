
class Guru {
  int nip;
  String namaGuru;
  String tempatLahirGuru;
  String tanggalLahirGuru;
  String jkGuru;
  String pendidikan;
  String alamatGuru;
  String agamaGuru;
  String noTelpGuru;

  Guru({
    required this.nip,
    required this.namaGuru,
    required this.tempatLahirGuru,
    required this.tanggalLahirGuru,
    required this.jkGuru,
    required this.pendidikan,
    required this.alamatGuru,
    required this.agamaGuru,
    required this.noTelpGuru,
  });

  factory Guru.fromJson(Map<String, dynamic> json) {
    return Guru(
      nip: json['nip'],
      namaGuru: json['nama_guru'],
      tempatLahirGuru: json['tempatlahir_guru'],
      tanggalLahirGuru: json['tanggallahir_guru'],
      jkGuru: json['jk_guru'],
      pendidikan: json['pendidikan'],
      alamatGuru: json['alamat_guru'],
      agamaGuru: json['agama_guru'],
      noTelpGuru: json['notelp_guru'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'nip': nip,
      'nama_guru': namaGuru,
      'tempatlahir_guru': tempatLahirGuru,
      'tanggallahir_guru': tanggalLahirGuru,
      'jk_guru': jkGuru,
      'pendidikan': pendidikan,
      'alamat_guru': alamatGuru,
      'agama_guru': agamaGuru,
      'notelp_guru': noTelpGuru,
    };
  }
}
