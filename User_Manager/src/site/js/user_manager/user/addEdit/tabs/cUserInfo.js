Ext.define('darkowl.userManager.user.addEdit.tabs.cUserInfo', {
	extend : 'Ext.form.Panel',
	closable : false,
	title : 'User Info',
	tooltip : 'Information about the user.',
	frame : true,
	labelWidth : 200,
	defaults : {
		anchor : "100%"
	},
	initComponent : function() {
		var obj_This = this;

		this.m_obj_PerTitle = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Personal Title",
			name : "perTitle",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_ProfTitle = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Profesional Title",
			name : "profTitle",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_FName = Ext.create("Ext.form.field.Text", {
			fieldLabel : "First Name",
			name : "fName",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_MName = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Middle Name",
			name : "mName",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_LName = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Last Name",
			name : "lName",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Affiliation = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Affiliation",
			name : "affiliation",
			inputType : "textfield",
			allowBlank : true
		});

		this.m_obj_Type = Ext.create("Ext.form.field.Text", {
			fieldLabel : "Type",
			name : "type",
			inputType : "textfield",
			allowBlank : true
		});

		this.callParent();

		this.add(this.m_obj_PerTitle);
		this.add(this.m_obj_ProfTitle);
		this.add(this.m_obj_FName);
		this.add(this.m_obj_MName);
		this.add(this.m_obj_LName);
		this.add(this.m_obj_Affiliation);
		this.add(this.m_obj_Type);
	}
});