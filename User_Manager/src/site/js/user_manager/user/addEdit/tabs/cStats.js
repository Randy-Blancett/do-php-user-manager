Ext.define('darkowl.userManager.user.addEdit.tabs.cStats', {
	extend : 'Ext.form.Panel',
	closable : false,
	title : 'Stats',
	tooltip : 'Statistics about the account.',
	labelWidth : 200,
	frame : true,
	defaults : {
		anchor : "100%"
	},
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Creation = Ext.create("Ext.form.field.Display", {
			fieldLabel : "Account Created",
			name : "accountCreated",
			inputType : "textfield"
		});

		this.m_obj_LastLogin = Ext.create("Ext.form.field.Display", {
			fieldLabel : "Last Login",
			name : "lastLogin",
			inputType : "textfield"
		});

		this.m_obj_LastUpdate = Ext.create("Ext.form.field.Display", {
			fieldLabel : "Last Update",
			name : "lastUpdate",
			inputType : "textfield"
		});

		this.callParent();

		this.add(this.m_obj_Creation);
		this.add(this.m_obj_LastLogin);
		this.add(this.m_obj_LastUpdate);
	}
});