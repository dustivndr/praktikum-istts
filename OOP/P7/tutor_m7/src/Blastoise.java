class Blastoise extends Pokemon {

    Blastoise() {
        // Data Blastoise diisi lewat constructor parent.
        super("Blastoise", 362);
    }

    // Override method abstract dari Pokemon.
    public void serang() {
        System.out.println(nama + " menyerang dengan Hydro Pump!");
    }

    public int getDamage() {
        return 28;
    }
}