Ext.define('darkowl.desktop.module.cExample',
{
	extend : 'darkowl.desktop.module.abs_Module',
	// singleton : true,
	m_str_Name : "Desktop Example",
	requires :
	[
		'Ext.data.Store'
	],
	constructor : function (config)
	{
		this.m_obj_Shortcuts = Ext.create('Ext.data.Store',
		{
			fields : darkowl.desktop.module.abs_Module.C_ARR_FIELDS,
			data :
			{
				'items' :
				[
					{
						'name' : 'Example Shortcut',
						"iconCls" : "menu-action-view-icon",
						onClick : function ()
						{
							alert("Test Alert Example");
						}
					}
				]
			},
			proxy :
			{
				type : 'memory',
				reader :
				{
					type : 'json',
					root : 'items'
				}
			}
		});
		
		this.m_obj_QuickStart = Ext.create('Ext.data.Store',
		{
			fields : darkowl.desktop.module.abs_Module.C_ARR_FIELDS,
			data :
			{
				'items' :
				[
					{
						'name' : 'Example Shortcut',
						"iconCls" : "menu-action-view-icon",
						onClick : function ()
						{
							alert("Quick Start Example");
						}
					}
				]
			},
			proxy :
			{
				type : 'memory',
				reader :
				{
					type : 'json',
					root : 'items'
				}
			}
		});
		this.buildGeneralMenu();
		this.buildSpecialMenu();
	},
	buildSpecialMenu : function ()
	{
		this.m_obj_SpecialStartMenu = new Ext.util.MixedCollection();
		
		this.m_obj_SpecialStartMenu.add('Special Level 1',
		{
			iconCls : "quickstart_logout_icon",
			onClick : function ()
			{
				alert("Special Level 1");
			}
		});
	},
	buildGeneralMenu : function ()
	{
		this.m_obj_GeneralStartMenu = new Ext.util.MixedCollection();
		
		this.m_obj_GeneralStartMenu.add('Level 1',
		{
			submenu : this.buildLevel1()
		});
	},
	buildLevel1 : function ()
	{
		var obj_Menu = new Ext.util.MixedCollection();
		
		obj_Menu.add('Level 1-1', this.buildLevel1_1());
		obj_Menu.add('Level 1-2', this.buildLevel1_2());
		return obj_Menu;
	},
	buildLevel1_1 : function ()
	{
		var obj_Menu =
		{
			submenu : null,
			iconCls : "quickstart_logout_icon",
			onClick : function ()
			{
				alert("Level 1-1 Example");
			}
		};
		return obj_Menu;
	},
	buildLevel1_2 : function ()
	{
		var obj_Menu =
		{
			submenu : null,
			iconCls : "quickstart_logout_icon",
			onClick : function ()
			{
				alert("Level 1-2 Example");
			}
		};
		return obj_Menu;
	}
});