Ext.define('darkowl.userManager.group.addEdit.tabs.cGroupInfo', {
	extend : 'Ext.form.Panel',
	title : 'Group Info',
	requires : [ 'Ext.form.field.ComboBox', 'Ext.button.Button',
			'darkowl.userManager.store.cGroupList',
			'darkowl.userManager.config.cLabel',
			'darkowl.userManager.config.cDialog',
			'darkowl.userManager.config.cButton',
			'darkowl.userManager.eventManager.cWorkFlowEvents' ],
	labelWidth : 100,
	m_str_GroupID : "",
	frame : true,
	bodyStyle : 'padding:5px 5px 0',
	defaultType : 'textfield',

	initComponent : function() {
		var obj_This = this;

		str_Width = "98%";

		this.waitMsgTarget = true;

		this.m_obj_Id = Ext.create('Ext.form.field.Text', {
			fieldLabel : userManager.lables.self.C_STR_ACTION_ID,
			name : "id",
			anchor : str_Width,
			readOnly : true,
			allowBlank : true
		});

		this.items = [ this.m_obj_Id, {
			fieldLabel : userManager.lables.self.C_STR_ACTION_NAME,
			name : "name",
			anchor : str_Width,
			inputType : "textfield",
			readOnly : false,
			allowBlank : false
		}, {
			fieldLabel : userManager.lables.self.C_STR_ACTION_COMMENT,
			name : "comment",
			anchor : str_Width,
			xtype : 'textareafield',
			allowBlank : true
		} ];

		this.callParent();
	},
	success_Submit : function(obj_Options) {
		this.ownerCt.close();
		userManager.MsgBus
				.fireEvent(userManager.MsgBus.self.C_STR_EVENT_GROUP_ADDED);
	},
	fail_Submit : function() {
		console.log("Fail Submit");
	},
	getGroupID : function() {
		return this.m_obj_Id.getValue();
	}
});