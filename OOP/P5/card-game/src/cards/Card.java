package cards;

public class Card {

    private String cardName, cardInitial, cardElement;
    private int cardHP, cardSkillPoint;

    public Card(String cardName, String cardInitial, String cardElement, int cardHP, int cardSkillPoint) {
        this.cardName = cardName;
        this.cardElement = cardElement;
        this.cardInitial = cardInitial;
        this.cardHP = cardHP;
        this.cardSkillPoint = cardSkillPoint;
    }

    public void cardNameInfo() {
        System.out.print(getCardName() + " - " + getCardElement());
    }

    // getters n setters

    public String getCardName() {
        return cardName;
    }

    public void setCardName(String cardName) {
        this.cardName = cardName;
    }

    public String getCardInitial() {
        return cardInitial;
    }

    public void setCardInitial(String cardInitial) {
        this.cardInitial = cardInitial;
    }

    public String getCardElement() {
        return cardElement;
    }

    public void setCardElement(String cardElement) {
        this.cardElement = cardElement;
    }

    public int getCardHP() {
        return cardHP;
    }

    public void setCardHP(int cardHP) {
        this.cardHP = cardHP;
    }

    public int getCardSkillPoint() {
        return cardSkillPoint;
    }

    public void setCardSkillPoint(int cardSkillPoint) {
        this.cardSkillPoint = cardSkillPoint;
    }
    
}
