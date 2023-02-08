package budgetapp.appUser;

import java.sql.Date;
import java.util.Calendar;

public class AppUser {
    private String uName;
    private String uPassword;
    private String uEmail;
    private Date uDate;
    private UserData[] data = new UserData[12];

    public AppUser() {
        for (int i = 0; i < data.length; i++) {
            if (data[i] == null) {
                data[i] = new UserData();
            }
        }
    }

    public AppUser(final String uname, final String password, final String email, final String date) throws Exception {
        this();
        setuName(uname);
        setPassword(password);
        setEmail(email);
        long mills = System.currentTimeMillis();
        java.sql.Date agreeDate = new java.sql.Date(mills);
        if (String.valueOf(agreeDate).compareTo(date) == 0) {
            setuDate(agreeDate);
        } else {
            throw new Exception("date submitted doesn't agree with sys date\n" + date + "\n" + agreeDate);
        }
    }

    public AppUser(final String uname, final String password, final String email, final String date, double expected)
            throws Exception {
        this(uname, password, email, date);
        int i = extractDate(date);
        data[i].setExpected(expected);
    }

    public AppUser(final String uname, final String password, final String email, final String date, double expected,
            double actual) throws Exception {
        this(uname, password, email, date, expected);
        int i = extractDate(date);
        data[i].setActual(actual);
    }

    public void setuName(String uname) {
        this.uName = uname;
    }

    public String getuName() {
        return this.uName;
    }

    public void setPassword(String password) {
        this.uPassword = password;
    }

    public String getPassword() {
        return this.uPassword;
    }

    public void setEmail(String email) {
        this.uEmail = email;
    }

    public String getEmail() {
        return this.uEmail;
    }

    public Date getuDate() {
        return uDate;
    }

    public void setuDate(Date uDate) {
        this.uDate = uDate;
    }

    public UserData[] getData() {
        return data;
    }

    public int extractDate(String dateSQLFormat) {
        java.sql.Date dat = java.sql.Date.valueOf(dateSQLFormat);
        return extractDate(dat);
    }

    public int extractDate(Date dat) {
        Calendar cal = Calendar.getInstance();
        cal.setTime(dat);
        int month = cal.get(Calendar.MONTH);
        return month;
    }

    public void setAllData(UserData[] newDat) throws Exception {
        if (newDat.length == data.length) {
            for (int i = 0; i < data.length; i++) {
                data[i].setActual(newDat[i].getActual());
                data[i].setExpected(newDat[i].getExpected());
            }
        } else {
            throw new Exception(
                    "Length of input param is of " + newDat.length + " size, looking for " + data.length + " size");
        }
    }

    @Override
    public String toString() {
        // Used for testing to get information about the AppUser
        return this.uName + ": " + "email: " + this.uEmail + " hashed password: " + this.uPassword; // + " id: " +
                                                                                                    // this.id;
    }
    // public String getId() {
    // return this.id;
    // }

    // public String hash(String pword) {
    // String hashedPassword = null;
    // try {
    // //Create MessageDigest instancce for MD5
    // MessageDigest md = MessageDigest.getInstance("MD5");

    // //Add password bytes to digest
    // md.update(pword.getBytes());

    // //Get the hash's bytes
    // byte[] bytes = md.digest();

    // //bytes[] has bytes in decimal format, so we convert it to hexadecimal
    // StringBuilder sb = new StringBuilder();
    // for (int i = 0; i < bytes.length; i++) {
    // sb.append(Integer.toString((bytes[i] & 0xff) + 0x100, 16).substring(1));
    // }
    // //Get complete hashed password in hex format
    // hashedPassword = sb.toString();
    // } catch (NoSuchAlgorithmException e) {
    // e.printStackTrace();
    // }
    // return hashedPassword;
    // }

    // public static void main(String[] args) throws Exception {
    // AppUser u1 = new AppUser("monkey", "password123", "monkey@gmail.com");
    // AppUser u2 = new AppUser("shadow", "123456", "shadow@gmail.com");
    // AppUser u3 = new AppUser("superman", "qwerty123", "superman@gmail.com");
    // HashMap<String, AppUser> map = new HashMap<>();
    // //adding new AppUser to the database
    // map.put(u1.getId(), u1);
    // map.put(u2.getId(), u2);
    // map.put(u3.getId(), u3);
    // //check for existence of a AppUser
    // if (map.containsKey(u1.getId())) {
    // System.out.println("for id: " + u1.getId() + " \nAppUser: " + u1.toString());
    // //delete a AppUser
    // map.remove(u1.getId());
    // if (!map.containsKey(u1.getId())) {
    // System.out.println("AppUser succcesfully removed");
    // }
    // }
    // }
}
