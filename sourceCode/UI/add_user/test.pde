
///*import interfascia.*;

//GUIController c;
//IFTextField txt_name,txt_uid;
//IFLabel lbl_name,lbl_uid;
//IFButton btn_addUser;
//void userForm() {
//  size(200, 100);
//  background(150);
  
//  c = new GUIController(this);
//  txt_name = new IFTextField("txt_name", 25, 30, 150);
//  lbl_name = new IFLabel("lbl_name", 25, 70);
//  lbl_uid = new IFLabel("lbl_uid",25,70);
//  txt_uid = new IFTextField("txt_uid", 25, 30, 150);
//  btn_addUser = new IFButton("btn_addUser",40,40,50,"Add User");
  
//  c.add(lbl_name);
//  c.add(txt_name);
//  c.add(lbl_uid);
//  c.add(txt_uid);
//  c.add(btn_addUser);
//  btn_addUser.addActionListener(this);
  
//}



//void actionPerformed(GUIEvent e) {
//  if (e.getMessage().equals("Completed")) {
//));  
//  }
//}*/



//String checkUIDAlreadyExists(rfid) {
//  String param="method=checkUIDAlreadyExists&uid="+rfid;
//  String url = "http://localhost/anshul/attendanceSystem/callApi.php?"+param;
//  String retMsg = '';
//  try {
//    String[] chkResp = loadStrings(url);
//    if (chkResp[0].equals("success")) {
//      retMsg = chkResp[1];
//    } else {
//      retMsg = chkResp[1];
      
//    }
//    //println("there are " + lines.length + " lines");
//    for (int i = 0; i < chkResp.length; i++) {
//      println(chkResp[i]);
//    }
//  }
//  catch(Exception e) {
//    println("Something Unexpected Happened Please try after Sometime!");
//  }
//  return retMsg;
//}
//void actionPerformed(GUIEvent e){
//  if(e.getSource() == btn_getUID){
//    if(rfid.equals(null) ||)
//  }
//}
///*void actionPerformed(GUIEvent e) {
//  if (e.getSource() == btn_getUID) {
//    //checking if rfid is not approximated or wrong data sent
//    if (rfid.equals(null)|| rfid.length()!=12)) {
//      lbl_error_success_msg.setLabel("Error: Unable to read data! Please Approximate TAG Nearer to device");
//    } else {
//      checkUIDAlreadyExists(rfid);
//    }
//    //println(rfid);
//  }
//  //if (e.getMessage().equals("Completed")) {
//    //l.setLabel(t.getValue());
//  //}

//}*/