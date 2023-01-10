package budgetapp.AppUser;

import java.util.HashMap;
import java.util.UUID;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class AppUser {
    private Long id;
    private String uname;
    private String hpassword;
    private String email;

    public AppUser() { }

    public AppUser(String uname, String password, String email) { 
        this.uname = uname;
        this.hpassword = hash(password);
        this.email = email;
        //this.id = UUID.randomUUID();
    }

    public String hash(String pword) {
        String hashedPassword = null;
        try {
            //Create MessageDigest instancce for MD5
            MessageDigest md = MessageDigest.getInstance("MD5");

            //Add password bytes to digest
            md.update(pword.getBytes());

            //Get the hash's bytes
            byte[] bytes = md.digest();

            //bytes[] has bytes in decimal format, so we convert it to hexadecimal
            StringBuilder sb = new StringBuilder();
            for (int i = 0; i < bytes.length; i++) {
                sb.append(Integer.toString((bytes[i] & 0xff) + 0x100, 16).substring(1));
            }
            //Get complete hashed password in hex format
            hashedPassword = sb.toString();
        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }
        return hashedPassword;
    }

    public void setUname(String uname) {
        this.uname = uname;
    }

    public String getUname() {
        return this.uname;
    }

    public void setPassword(String password) {
        this.hpassword = hash(password);
    }

    public String getPassword() {
        return this.hpassword;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEmail() {
        return this.email;
    }

    // public String getId() {
    //     return this.id;
    // }

    @Override
    public String toString() {
        //Used for testing to get information about the AppUser
        return this.uname + ": " + "email: " + this.email + " hashed password: " + this.hpassword + " id: " + this.id;
    }

    // public static void main(String[] args) throws Exception {
    //     AppUser u1 = new AppUser("monkey", "password123", "monkey@gmail.com");
    //     AppUser u2 = new AppUser("shadow", "123456", "shadow@gmail.com");
    //     AppUser u3 = new AppUser("superman", "qwerty123", "superman@gmail.com");
    //     HashMap<String, AppUser> map = new HashMap<>();
    //     //adding new AppUser to the database
    //     map.put(u1.getId(), u1);
    //     map.put(u2.getId(), u2);
    //     map.put(u3.getId(), u3);
    //     //check for existence of a AppUser
    //     if (map.containsKey(u1.getId())) {
    //         System.out.println("for id: " + u1.getId() + " \nAppUser: " + u1.toString());
    //         //delete a AppUser
    //         map.remove(u1.getId());
    //         if (!map.containsKey(u1.getId())) {
    //             System.out.println("AppUser succcesfully removed");
    //         }
    //     }
    // }
}

