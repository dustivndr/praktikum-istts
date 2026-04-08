package card;

public class Card {

    String name;
    int hp, damage, elixirCost;

    public Card(String name, int hp, int damage, int elixirCost) {
        this.name = name;
        this.hp = hp;
        this.damage = damage;
        this.elixirCost = elixirCost;
    }

    public void displayForSelect() {
        System.out.print(name + " [COST: " + elixirCost + "]");
    }
    
}
