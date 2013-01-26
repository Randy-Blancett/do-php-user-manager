Ext.define('darkowl.userManager.user.addEdit.cTopForm', {
	extend : 'Ext.form.Panel',
	layout : 'fit',
    m_str_UserID : "",
	border : false,
	requires : [ 'darkowl.userManager.user.addEdit.cTabForm',
			'darkowl.userManager.config.cButton' ],
	initComponent : function() {
		var obj_This = this;

		this.m_obj_Tabs = Ext
				.create('darkowl.userManager.user.addEdit.cTabForm');

		this.m_obj_Submit = Ext.create('Ext.button.Button', {
			text : userManager.button.self.C_STR_GENERAL_SAVE,
			formBind : true,
			// disabled:(!this.m_str_UserID),
			scope : this,
			handler : function() {
				var str_ID = this.m_obj_Tabs.getUserID();

				var str_Method = "POST";
				if (str_ID) {
					str_Method = "PUT";
				}

				var form = this.getForm();
				if (form.isValid()) {
					form.submit({
						headers : {
							Accept : "application/json"
						},
						scope : obj_This,
						url : '../rest/user/' + str_ID,
						waitMsg : userManager.dialog.self.C_STR_USER_SAVE_WAIT,
						method : str_Method,
						success : obj_This.success_Submit,
						failure : obj_This.fail_Submit
					});
				}

			}
		});

		this.m_obj_Cancel = Ext.create('Ext.button.Button', {
			text : userManager.button.self.C_STR_GENERAL_CANCEL,
			handler : function() {
				this.up("window").close();
			}
		});

		this.buttons = [];

		this.buttons.push(this.m_obj_Submit);
		this.buttons.push(this.m_obj_Cancel);

		this.callParent();

		this.add(this.m_obj_Tabs);
	},
	success_Submit : function(obj_Options) {
		this.up("window").close();
		userManager.MsgBus
				.fireEvent(userManager.MsgBus.self.C_STR_EVENT_USER_ADDED);
	},
	fail_Submit : function(obj_Form, obj_Action) {
		var obj_Response = Ext.decode(obj_Action.response.responseText);
		var str_Msg = "";

		console.log(obj_Response);

		for (int_Key in obj_Response.errors) {
			str_Msg += obj_Response.errors[int_Key] + "<br/>";
		}

		Ext.Msg.alert("Failed", str_Msg);
	}
});