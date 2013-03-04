Ext.define('darkowl.userManager.user.addEdit.tabs.cComments', {
	extend : 'Ext.form.Panel',
	closable : false,
	title : 'Comments',
	tooltip : 'Comments about the user.',
	frame : true,
	labelWidth : 200,
	defaults : {
	// anchor : "100%"
	},
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Comment = Ext.create("Ext.form.field.TextArea", {
			fieldLabel : "Comment",
			name : "comment",
			inputType : "textfield",
			disabled : false,
			anchor : "100% 100%",
			allowBlank : true
		});

		this.callParent();

		this.add(this.m_obj_Comment);
	}
});