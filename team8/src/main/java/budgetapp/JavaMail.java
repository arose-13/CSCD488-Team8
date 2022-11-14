package budgetapp;

import java.util.*;
import javax.mail.*;
import javax.mail.internet.*;
import javax.activation.*;
import javax.mail.Session;
import javax.mail.Transport;


public class JavaMail {
    public static void main(String[] args) throws Exception {
        // email ID of Recipient.
      String toEmail = "team.eight.noreply@gmail.com";
 
      // email ID of  Sender.
      String fromEmail = "team.eight.noreply@gmail.com";
 
      // using host as localhost
      String host = "smtp.gmail.com";
 
      // Getting system properties
      Properties properties = new Properties();
 
      // Setting up mail server
      properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
      properties.put("mail.smtp.auth", "true");
      properties.put("mail.smtp.starttls.enable", "true");
      properties.put("mail.smtp.host", host);
      properties.put("mail.smtp.port", "587");
      
 
      // creating session object to get properties
      Session session = Session.getInstance(properties, new Authenticator() {
        @Override
        protected PasswordAuthentication getPasswordAuthentication() {
            return new PasswordAuthentication("team.eight.noreply@gmail.com", "ipystdmpjnhutxyq");
        }
      });
 
      try
      {
         // MimeMessage object.
         MimeMessage msg = new MimeMessage(session);
 
         //set message headers
	      msg.addHeader("Content-type", "text/HTML; charset=UTF-8");
	      msg.addHeader("format", "flowed");
	      msg.addHeader("Content-Transfer-Encoding", "8bit");

	      msg.setFrom(new InternetAddress(fromEmail, "Team8NoReply"));

	      msg.setReplyTo(InternetAddress.parse(fromEmail, false));

	      msg.setSubject("Default Subject", "UTF-8");

	      msg.setText("Default Body", "UTF-8");

	      msg.setSentDate(new Date());

	      msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(toEmail, false));
	      System.out.println("Message is ready");
    	  Transport.send(msg);  
         System.out.println("Mail successfully sent");
      }
      catch (MessagingException mex)
      {
         mex.printStackTrace();
      }
    }
}
