Ext.define('darkowl.userManager.config.cConfigTab',
	{
		title: "User Manager Configuration",
		frame: true,
		extend: 'darkowl.desktop.config.abs_ConfigTab',
		initComponent: function() {
			this.category = "UserManager";


			this.callParent();
		}
	});


