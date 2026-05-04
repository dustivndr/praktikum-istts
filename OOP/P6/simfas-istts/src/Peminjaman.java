
public class Peminjaman {

    private final String namaPeminjam;
    private final String namaBarangDipinjam;
    private final String jumlah;
    private final String alasan;
    private final String penanggung;
    private boolean penanggungConfirmed;
    private boolean adminConfirmed;
    private final String type;

    public Peminjaman(String namaPeminjam, String namaBarangDipinjam, String jumlah, String alasan, String penanggung, boolean penanggungConfirmed, boolean adminConfirmed, String type) {
        this.namaPeminjam = namaPeminjam;
        this.namaBarangDipinjam = namaBarangDipinjam;
        this.jumlah = jumlah;
        this.alasan = alasan;
        this.penanggung = penanggung == null || penanggung.isEmpty() ? "x" : penanggung;
        this.penanggungConfirmed = penanggungConfirmed;
        this.adminConfirmed = adminConfirmed;
        this.type = type;
    }

    public String getNamaPeminjam() {
        return namaPeminjam;
    }

    public String getNamaBarangDipinjam() {
        return namaBarangDipinjam;
    }

    public String getJumlah() {
        return jumlah;
    }

    public String getAlasan() {
        return alasan;
    }

    public String getPenanggung() {
        return penanggung;
    }

    public boolean isPenanggungConfirmed() {
        return penanggungConfirmed;
    }

    public void setPenanggungConfirmed(boolean penanggungConfirmed) {
        this.penanggungConfirmed = penanggungConfirmed;
    }

    public boolean isAdminConfirmed() {
        return adminConfirmed;
    }

    public void setAdminConfirmed(boolean adminConfirmed) {
        this.adminConfirmed = adminConfirmed;
    }

    public String getType() {
        return type;
    }

    public boolean isReady() {
        return penanggungConfirmed && adminConfirmed;
    }

}
