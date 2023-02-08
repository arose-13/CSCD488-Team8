package budgetapp.appUser;

public class UserData {
    
    private double expected;
    private double actual;

    // private double income;
    // public double getIncome() {
    //     return income;
    // }
    // public void setIncome(double income) {
    //     this.income = income;
    // }
    // public appUserData() {
    //     setActual(0.00);
    //     setExpected(0.00);
    //     setIncome(0.00);
    // }
    // public appUserData(double expected, double actual, double income) {
    //     this(expected, actual);
    //     this.setIncome(income);
    // }


    public UserData() {
        setActual(0.00);
        setExpected(0.00);
    }

    public UserData(double expected) {
        this();
        setExpected(expected);
    }

    public UserData(double expected, double actual) {
        this(expected);
        setActual(actual);
    }


    public double getExpected() {
        return expected;
    }

    public void setExpected(double expected) {
        this.expected = expected;
    }

    public double getActual() {
        return actual;
    }

    public void setActual(double actual) {
        this.actual = actual;
    }

}
