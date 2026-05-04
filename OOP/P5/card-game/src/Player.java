import cards.Card;

public class Player {

    private final int playerNumber;
    private final Card[] selectedCards;
    private Card activeCard;

    public Player(int playerNumber, Card[] selectedCards, Card activeCard) {
        this.playerNumber = playerNumber;
        this.selectedCards = selectedCards;
        this.activeCard = activeCard;
    }

    public int getPlayerNumber() {
        return playerNumber;
    }

    public Card[] getSelectedCards() {
        return selectedCards;
    }

    public Card getActiveCard() {
        return activeCard;
    }

    public void setActiveCard(Card activeCard) {
        this.activeCard = activeCard;
    }
}
