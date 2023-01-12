package budgetapp.JavaEmail;

import budgetapp.AppUser.AppUser;

import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import javax.mail.Session;
import javax.mail.Transport;
import java.sql.*;
import java.sql.Date;

public class JavaMail {
  private String toEmail = "team.eight.noreply@gmail.com";
  private final String fromEmail = "team.eight.noreply@gmail.com";
  private Session session;
  private MimeMessage msg;
  private AppUser user;

  public JavaMail() throws Exception {
    this.session = setUpEmailSession();
    this.msg = new MimeMessage(this.session);
  }

  public JavaMail(final String to) throws Exception {
    this();
    this.toEmail = to;
  }

  public JavaMail(final AppUser user) throws Exception {
    this(user.getEmail());
    this.user = user;
  }

  //more sanity check
  public static void main(String[] args) throws Exception {

    java.util.Date d = new java.util.Date();
    System.out.println(d);
    java.sql.Date date = new java.sql.Date(d.getTime());
    System.out.println(date);
    
    AppUser test = new AppUser("testName", "testPassNotHash", "team.eight.noreply@gmail.com", date);
    JavaMail myMail = new JavaMail(test);
    boolean sent = myMail.sendAuthenticationEmail(test);
    System.out.println(sent);
  }

  private String getRandom() {
    Random random = new Random();
    int code = random.nextInt(999999);
    return String.format("%06d", code);
  }

  private void setMessage(final String subject, final String body) throws Exception {
    // set message headers
    this.msg.addHeader("Content-type", "text/HTML; charset=UTF-8");
    this.msg.addHeader("format", "flowed");
    this.msg.addHeader("Content-Transfer-Encoding", "8bit");

    this.msg.setFrom(new InternetAddress(this.fromEmail, "Team8 NoReply"));

    this.msg.setReplyTo(InternetAddress.parse(this.user.getEmail(), false));

    this.msg.setSubject(subject, "UTF-8");

    this.msg.setText(body, "UTF-8");

    this.msg.setSentDate(new java.util.Date());

    this.msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(this.toEmail, false));
    System.out.println("Message is ready");
  }

  private Session setUpEmailSession() throws Exception {
    try {
      // using host as localhost
      final String host = "smtp.gmail.com";

      // Getting system properties
      Properties properties = new Properties();

      // Setting up mail server / setting properties
      properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
      properties.put("mail.smtp.auth", "true");
      properties.put("mail.smtp.starttls.enable", "true");
      properties.put("mail.smtp.host", host);
      properties.put("mail.smtp.port", "587");
      properties.put("mail.smtp.socketFactory.port", "587");
      properties.put("mail.smtp.socketFactory.class", "javax.net.ssl.SSLSocketFactory");

      // creating session object to get properties
      Session session = Session.getInstance(properties, new Authenticator() {
        @Override
        protected PasswordAuthentication getPasswordAuthentication() {
          return new PasswordAuthentication("team.eight.noreply@gmail.com", "ipystdmpjnhutxyq");
        }
      });
      return session;
    } catch (Exception e) {
      System.out.println("error setting up email server connection\n");
      throw new Exception(e);
    }
  }

  public boolean sendAuthenticationEmail(AppUser user) throws Exception {
      boolean sent = false;
      String verification = this.getRandom();
      try {
        this.setMessage("Default Email Authentication Email Subject", "Default Authenticaiton Email Body Text\n"+user.getEmail()+"\n"+"User Verification Code: "+verification);
        Transport.send(this.msg);
        System.out.println("Mail successfully sent");
        sent = true;
      } catch (MessagingException mex) {
        mex.printStackTrace();
      }
      return sent;
  }

  public boolean sendDeleteAccountEmail(AppUser user) throws Exception {
      boolean sent = false;
      try {
        this.setMessage("Default Account Deletion Email Subject", "Default Deletion Email Body Text\n"+user.getEmail()+"\n"+user.getPassword());
        Transport.send(this.msg);
        System.out.println("Mail successfully sent");
        sent = true;
      } catch (MessagingException mex) {
        mex.printStackTrace();
      }
      return sent;
  }

  public boolean sendEmail(AppUser user, String Subject, String Body) throws Exception {
      boolean sent = false;
    try {
      this.setMessage(Subject, Body+user.getEmail()+"\n"+user.getPassword());
      Transport.send(this.msg);
      System.out.println("Mail successfully sent");
      sent = true;
    } catch (MessagingException mex) {
      mex.printStackTrace();
    }
    return sent;
  }
}



  // //Sanity check for testing
  // public static void main(String[] args) throws Exception {
  //   JavaMail myMail = new JavaMail("team.eight.noreply@gmail.com", "deleteAccount");
  //   try {
  //     if (myMail.type == "default") {
  //       myMail.setMessage("default subject", "default body");
  //     } else if (myMail.type == "authentication") {
  //       myMail.setMessage("Account Authentication", "Account Authentication Default Text");

  //     } else if (myMail.type == "deleteAccount") {
  //       myMail.setMessage("Account Deletion", "Account Deletion Default Text");
  //     } else {
  //       System.out.println("myMail.type not valid");
  //       throw new Exception();
  //     }
  //     Transport.send(myMail.msg);
  //     System.out.println("Mail successfully sent");
  //   } catch (MessagingException mex) {
  //     mex.printStackTrace();
  //   }
  // }