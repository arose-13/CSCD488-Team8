# CSCD488-Team8

Spring-Winter 2022 Group Assignment

# Group Members:
  - Nathan Graham
  - Alan Rose
  - Nathan Nelson
  - Ray Vernon

<----------------------------------->

# java -version
- java version "18.0.1.1" 2022-04-22  
  Java(TM) SE Runtime Environment (build 18.0.1.1+2-6)  
  Java HotSpot(TM) 64-Bit Server VM (build 18.0.1.1+2-6, mixed mode, sharing)  

<----------------------------------->
# This project was init with Maven

- mvn -v  
  Apache Maven 3.8.5 (3599d3414f046de2324203b78ddcf9b5e4388aa0)  
  Maven home: C:\Program Files\apache-maven-3.8.5  
  Java version: 18.0.1.1, vendor: Oracle Corporation, runtime: C:\Program Files\Eclipse Foundation\jdk-18  
  Default locale: en_US, platform encoding: UTF-8  
  OS name: "windows 10", version: "10.0", arch: "amd64", family: "windows"  

## To launch Maven
* Install the Community Server Connectors VSCode extension
* Create new tomcat server by selecting the folder `apache-tomcat-9.0.69`
* Navigate to `team8`
* Execute the command `mvn clean install`
* Add a deployment to the Tomcat server, and select the file `team8-0.1.war` within the `/team8/target` directory
* Start the server
