import processing.serial.*;
int lf=10;
int value;
String myString = null;
String finalString = null;
String rfid = null;
Serial myPort;
int clk=0;
JSONObject json;
void setup() {
  size(700, 300);
  myPort = new Serial(this, Serial.list()[1], 9600);
  myPort.clear();
  myString = myPort.readStringUntil(lf);
  myString = null;
  userForm(); //<>//
}
void draw() { //<>//
  
 //getting data from serial port when data coming
  while (myPort.available()>0) {
    myString = myPort.readStringUntil(lf);
    if (myString!=null) {
      myString = trim(myString);
    }
    //smooth();
  }

    if (myString !=null) {
      String []myStringAr = split(myString, " ");
       rfid = join(myStringAr, "");
       boolean chkFlag = checkUIDAlreadyExists(rfid);
    }
    
  myString = null;
}
boolean checkUIDAlreadyExists(String rfid) {
  boolean bool=false;;
  String param="method=checkUIDAlreadyExists&uid="+rfid;
  String url = "http://localhost/anshul/attendanceSystem/callApi.php?"+param;
  String retMsg = null;
  try {
    String[] chkStrRespAr = loadStrings(url);
    
      retMsg = chkStrRespAr[0];
      if(retMsg.equals("0")){
        
        lbl_error_success_msg.setLabel("This card is already Registered!");
        println("Card Already Exists!");
      }else if(retMsg.equals("1")){
        
        //Showing Add button and UID LABEL
        bool=true;
        lbl_uid.setPosition(120, 130);
        lbl_uid.setLabel(rfid);
        
        //ADDING BUTTON
        c.add(btn_addUser);
      }else{
        //SETTING MSG LABEL
        lbl_error_success_msg.setLabel("Invalid Card UID Provided!");
      }
  }
  catch(Exception e) {
    println("Something Unexpected Happened Please try after Sometime!");
  }
  delay(1000);
  return bool;
  
}
void addUser(){
  String param="method=addUser&uid="+rfid;
  param+="&name="+txt_name.getValue();
  String url = "http://localhost/anshul/attendanceSystem/callApi.php?"+param;
  
  String[] chkStrRespAr = loadStrings(url);
  for(int i=0;i<chkStrRespAr.length;i++){
    println(chkStrRespAr[i]);
  }
  String retMsg = chkStrRespAr[0];
  println(retMsg);
  lbl_error_success_msg.setLabel(retMsg);
  
}