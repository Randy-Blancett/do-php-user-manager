Ext.define('darkowl.userManager.login.cLoginForm', {
	extend : 'Ext.form.Panel',
	// autoWidth : true,
	// autoHeight : true,
	labelWidth : 50,
	animCollapse : false,
	// url : "Login_Process.php",
	frame : true,
	bodyStyle : 'padding:5px 5px 0',
	// standardSubmit : true,
	width : 350,
	defaults : {
		anchor : "100%"
	},
	fieldDefaults : {
		labelAlign : 'left',
		msgTarget : 'side'
	},
	defaultType : 'textfield',

	initComponent : function() {
		var obj_This = this;

		this.m_obj_UserName = Ext.create("Ext.form.field.Text", {
			anchor : "100%",
			fieldLabel : "User Name",
			tabIndex : 1,
			name : 'userName',
			inputType : "textfield",
			allowBlank : false,
			value : G_STR_FORM_DATA_USERNAME
		});

		this.m_obj_Password = Ext.create("Ext.form.field.Text", {
			anchor : "100%",
			fieldLabel : "Password",
			name : 'password',
			inputType : "password",
			allowBlank : false
		});

		this.items = [ this.m_obj_UserName, this.m_obj_Password ];

		this.m_obj_Submit = Ext.create('Ext.Button', {
			text : 'Login',
			formBind : true,
			handler : function() {
				this.submit();
			},
			scope : this
		});

		this.buttons = [ this.m_obj_Submit ];
		this.callParent();
	},

	submit : function() {
		var obj_This = this;
		var form = this.getForm();

		if (form.isValid()) {
			form.submit({
				headers : {
					Accept : "application/json"
				},
				scope : obj_This,
				url : "../rest/login",
				waitMsg : "Attempting to login",
				method : "POST",
				success : function(form, action) {
					location.replace(action.result.url);
				},
				failure : function(form, action) {
					Ext.Msg.alert('Failed', action.result.errors.msg);
				}
			});
		}
		// var form = this.getForm();
		// if (form.isValid())
		// {
		// form.submit(
		// {
		// url : "loginProcess.php",
		// standardSubmit : true,
		// success : function(form, action)
		// {
		// location.replace(action.result.url);
		// },
		// failure : function(form, action)
		// {
		// Ext.Msg.alert('Failed', action.result.errors.msg);
		// }
		// });
		// }
	}
});