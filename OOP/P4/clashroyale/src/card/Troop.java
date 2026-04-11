package card;

public class Troop extends Card {

    private int forcedTowerTarget = -1;

    public Troop(String name, int hp, int damage, int elixirCost) {
        super(name, hp, damage, elixirCost);
    }

    public boolean hasForcedTowerTarget() {
        return forcedTowerTarget >= 0;
    }

    public int getForcedTowerTarget() {
        return forcedTowerTarget;
    }

    public void setForcedTowerTarget(int forcedTowerTarget) {
        this.forcedTowerTarget = forcedTowerTarget;
    }

    public void clearForcedTowerTarget() {
        this.forcedTowerTarget = -1;
    }

}
