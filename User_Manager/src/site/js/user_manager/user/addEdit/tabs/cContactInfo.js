Ext.define('darkowl.userManager.user.addEdit.tabs.cContactInfo', {
	extend : 'Ext.form.Panel',
	closable : false,
	title : 'Contact Info',
	tooltip : 'Infomration to contact user.',
	frame : true,
	defaults : {
		anchor : "100%",
		labelWidth : 200
	},
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Phone1 = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Phone 1",
			name : "phone1",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Phone2 = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Phone 2",
			name : "phone2",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Email1 = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Email 1",
			name : "email1",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Email2 = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Email 2",
			name : "email2",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Company = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Company",
			name : "company",
			inputType : "textfield",
			allowBlank : true
		});

		this.callParent();

		this.add(this.m_obj_Phone1);
		this.add(this.m_obj_Phone2);
		this.add(this.m_obj_Email1);
		this.add(this.m_obj_Email2);
		this.add(this.m_obj_Company);
	}
});