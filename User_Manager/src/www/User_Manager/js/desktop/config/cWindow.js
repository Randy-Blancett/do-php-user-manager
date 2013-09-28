Ext.define('darkowl.desktop.config.cWindow', {
	extend: 'darkowl.desktop.cDesktopWindow',
	title: "View Actions",
	requires: [
		'Ext.tab.Panel',
		'Ext.form.Panel',
		'Ext.button.Button',
		'darkowl.userManager.config.cButton',
		'darkowl.desktop.config.cConfigTab'
	],
	iconCls: "window-config-icon ",
	width: 600,
	height: 480,
	shim: false,
	animCollapse: false,
	constrain: true,
	m_obj_Tab: null,
	m_obj_Mask: null,
	layout: "fit",
	border: false,
	constructor: function(config) {
		this.callParent(arguments);
		this.addMsgEvents();
	},
	addMsgEvents: function() {
		// this.addEvents(this.self.C_STR_EVENT_EDIT,
		// this.self.C_STR_EVENT_DELETE);
		// this.on(this.self.C_STR_EVENT_EDIT, this.editAction);
		// this
		// .on(this.self.C_STR_EVENT_DELETE,
		// this.deleteAction);
	},
	initComponent: function() {
		var obj_This = this;

		this.m_obj_Tab = Ext.create('Ext.tab.Panel');

		this.items = [
			this.m_obj_Tab
		];

		this.m_obj_Tab.add(Ext.create('darkowl.desktop.config.cConfigTab'));

		for (var i = 0;
			i <
			g_arr_ConfigTabs.length;
			i++)
		{
			this.m_obj_Tab.add(Ext.create(g_arr_ConfigTabs[i]));
		}

		this.m_obj_Submit = Ext.create('Ext.button.Button', {
			text: userManager.button.self.C_STR_GENERAL_SAVE,
			formBind: true,
			scope: obj_This,
			handler: this.saveEachTab
		});

		this.m_obj_Cancel = Ext.create('Ext.button.Button', {
			text: userManager.button.self.C_STR_GENERAL_CANCEL,
			handler: function() {
				this.up("window").close();
			}
		});

		this.buttons = [
			this.m_obj_Submit,
			this.m_obj_Cancel
		];
		this.callParent();

		this.on("afterrender", function() {
			if (this.m_bool_Mask) {
				this.showMask();
			}
		});
		this.loadConfig();
	},
	success_Submit: function()
	{
		this.close();
	},
	fail_Submit: function()
	{
		console.log("Fail Submit");
	},
	showMask: function() {
		this.m_bool_Mask = true;
		if (this.getEl()) {
			if (!this.m_obj_Mask) {
				this.m_obj_Mask = new Ext.LoadMask(this.getEl(), {
					msg: "Loading Configuration Data..."
				});
			}
			this.m_obj_Mask.show();
		}
	},
	saveEachTab: function() {
		this.m_obj_Tab.items.each(this.saveTab, this);
		this.close();
	}
	,
	saveTab: function(objItem, intIndex, intLength) {
		console.log("Save Tab");
		var form = objItem.getForm();
		if (form.isValid()) {
			form.submit({
				headers: {
					Accept: "application/json"
				},
				scope: objItem,
				url: '../rest/config/' +
					objItem.category,
				waitMsg: userManager.dialog.self.C_STR_DIALOG_GENERIC_SAVE_WAIT,
				method: "POST"
//				,
//				success: obj_This.success_Submit,
//				failure: obj_This.fail_Submit
			});
		}
	},
	loadTabConfig: function(objItem, intIndex, intLength) {
		objItem.loadConfig();
	},
	loadConfig: function() {
		this.m_obj_Tab.items.each(this.loadTabConfig, this);

	},
	hideMask: function() {
		this.m_bool_Mask = true;
		if (this.getEl()) {
			if (!this.m_obj_Mask) {
				return;
			}
			this.m_obj_Mask.hide();
		}
	}
});
