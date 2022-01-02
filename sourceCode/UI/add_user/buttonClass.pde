import interfascia.*;

GUIController c;
IFTextField txt_name;
IFLabel lbl_name, lbl_uid, lbl_uid_msg, lbl_error_success_msg, lbl_heading, lbl_uid_txt;
IFButton btn_addUser, btn_getUID;
void userForm() { //<>//
  //size(200, 100);
  background(150);

  c = new GUIController(this);
  lbl_heading = new IFLabel("User UID Add Panel", 230, 20);

  lbl_error_success_msg = new IFLabel("", 140, 40);

  lbl_name = new IFLabel("Enter Name", 30, 90);
  txt_name = new IFTextField("txt_name", 120, 86, 200);

  lbl_uid = new IFLabel("UID", 30, 130);
  lbl_uid_txt = new IFLabel("", 120, 130);

  lbl_uid_msg = new IFLabel("* Please approximate your card to device \n and press Get UID", 350, 80);

  btn_addUser = new IFButton("Add User", 200, 190, 80, 20);
  btn_getUID = new IFButton("Get Uid", 300, 190, 80);

  c.add(lbl_heading);
  c.add(lbl_error_success_msg);

  c.add(lbl_name);
  c.add(txt_name);

  c.add(lbl_uid);
  c.add(lbl_uid_txt);
  c.add(lbl_uid_msg);


  //c.add(btn_addUser);
  //c.add(btn_getUID);
  btn_getUID.setSize(60, 20);

  btn_addUser.addActionListener(this);
  btn_getUID.addActionListener(this);
}

void actionPerformed (GUIEvent e) {
  //if (e.getSource() == btn_getUID) {
    
  //} else 
  if (e.getSource() == btn_addUser) {
    addUser();
    
    println("Button two was clicked");
  }
}