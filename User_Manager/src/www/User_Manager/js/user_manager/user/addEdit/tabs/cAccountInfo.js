Ext.define('darkowl.userManager.user.addEdit.tabs.cAccountInfo', {
	extend : 'Ext.form.Panel',
	closable : false,
	frame : true,
	title : 'Account Info',
	tooltip : 'Account Info',
	m_bool_Editable : true,
	labelWidth : 200,
	defaults : {
		anchor : "100%"
	},
	initComponent : function() {
		var obj_This = this;

		this.m_obj_UserId = Ext.create("Ext.form.field.Text", {
			fieldLabel : "User ID",
			name : "userID",
			inputType : "textfield",
			readOnly : true,
			allowBlank : true
		});

		this.m_obj_UserName = Ext.create("Ext.form.field.Text", {
			fieldLabel : "User Name",
			name : "userName",
			inputType : "textfield",
			disabled : false,
			readOnly : !this.m_bool_Editable,
			allowBlank : false
		});

		this.m_obj_Password = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Password",
			name : "password",
			inputType : "password",
			disabled : false,
			allowBlank : true
		});

		this.m_obj_Password_Confirm = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Confirm Password",
			name : "passwordConfirm",
			inputType : "password",
			disabled : false,
			allowBlank : true,
			vtype : 'password',
			initialPassField : this.m_obj_Password
		});

		this.callParent();
		this.add(this.m_obj_UserId);
		this.add(this.m_obj_UserName);
		this.add(this.m_obj_Password);
		this.add(this.m_obj_Password_Confirm);
	},
	getUserID : function() {
		return this.m_obj_UserId.getValue();
	}
});