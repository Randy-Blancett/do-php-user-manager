Ext.define('darkowl.desktop.cStartMenu',
{
	extend : 'Ext.panel.Panel',
	
	requires :
	[
			'Ext.menu.Menu', 'Ext.toolbar.Toolbar',
			'darkowl.desktop.eventManager.cDesktopEvents'
	],
	m_obj_Logout : null,
	m_obj_Sep : null,
	
	ariaRole : 'menu',
	cls : 'x-menu ux-start-menu',
	defaultAlign : 'bl-tl',
	iconCls : 'start-icon',
	floating : true,
	shadow : true,
	layout : 'fit',
	
	// We have to hardcode a width because the internal Menu
	// cannot drive our width.
	// This is combined with changing the align property of the
	// menu's layout from the
	// typical 'stretchmax' to 'stretch' which allows the the
	// items to fill the menu area.
	width : 300,
	height : 300,
	initComponent : function ()
	{
		
		this.buildMenu();
		
		this.items =
		[
			this.m_obj_Menu
		];
		
		Ext.menu.Manager.register(this);
		
		this.callParent();
		
		this.buildToolbar();
		this.addDocked(this.m_obj_Toolbar);
		
		this.on('deactivate', function ()
		{
			this.hide();
		});
	},
	addMenuItem : function (str_Text, obj_Menu, obj_Data)
	{
		var obj_Current = null;
		var str_ID = null;
		var obj_Submenu = obj_Data.submenu;
		var bool_IsMenu = false;
		
		if (obj_Submenu != null && obj_Submenu.getCount() > 0)
		{
			bool_IsMenu = true;
		}
		
		str_ID = str_Text;
		
		if (bool_IsMenu)
		{
			str_ID += "Menu";
		}
		else
		{
			str_ID += "Function";
		}
		
		obj_Current = obj_Menu.items.get(str_ID);
		
		if (!obj_Current)
		{
			var obj_NewItem =
			{
				text : str_Text,
				id : str_ID
			};
			if (bool_IsMenu)
			{
				obj_NewItem.menu = [];
			}
			obj_Current = Ext.create('Ext.menu.Item', obj_NewItem);
			obj_Menu.add(obj_Current);
		}
		
		if (bool_IsMenu)
		{
			this.addMenu2Button(obj_Current, obj_Submenu);
		}
		else
		{
			obj_Current.on('click', obj_Data.onClick, this);
		}
	},
	addToolbarItem : function (str_Text, obj_Menu, obj_Data)
	{
		var obj_Current = null;
		var str_ID = null;
		var obj_Submenu = obj_Data.submenu;
		var bool_IsMenu = false;
		
		if (obj_Submenu != null && obj_Submenu.getCount() > 0)
		{
			bool_IsMenu = true;
		}
		
		str_ID = str_Text;
		
		if (bool_IsMenu)
		{
			str_ID += "Menu";
		}
		else
		{
			str_ID += "Function";
		}
		
		obj_Current = obj_Menu.items.get(str_ID);
		
		if (!obj_Current)
		{
			var obj_NewItem =
			{
				text : str_Text,
				id : str_ID,
				iconCls : obj_Data.iconCls
			};
			if (bool_IsMenu)
			{
				obj_NewItem.menu = [];
			}
			obj_Current = obj_Menu.add(obj_NewItem);
		}
		
		if (bool_IsMenu)
		{
			this.addMenu2Button(obj_Current, obj_Submenu);
		}
		else
		{
			obj_Current.on('click', obj_Data.onClick, this);
		}
	},
	addMenu2Button : function (obj_Button, obj_SubMenu)
	{
		obj_SubMenu.eachKey(function (str_Key, obj_Data)
		{
			this.addMenuItem(str_Key, obj_Button.menu, obj_Data);
		}, this);
	},
	
	addStartMenu : function (obj_Data)
	{
		// darkowl.desktop.util.cLogger.log(obj_Data);
		if (obj_Data.general)
		{
			obj_Data.general.eachKey(function (str_Key, obj_Data)
			{
				this.addMenuItem(str_Key, this.m_obj_Menu, obj_Data);
			}, this);
		}
		
		if (obj_Data.special)
		{
			this.m_obj_Toolbar.remove(this.m_obj_Sep);
			this.m_obj_Toolbar.remove(this.m_obj_ToEnd);
			this.m_obj_Toolbar.remove(this.m_obj_Logout);
			
			obj_Data.special.eachKey(function (str_Key, obj_Data)
			{
				this.addToolbarItem(str_Key, this.m_obj_Toolbar, obj_Data);
			}, this);
			
			this.m_obj_Toolbar.add(this.m_obj_ToEnd);
			this.m_obj_Toolbar.add(this.m_obj_Sep);
			this.m_obj_Toolbar.add(this.m_obj_Logout);
		}
		// this.m_obj_Menu
		// this.m_obj_Toolbar
	},
	
	buildToolbar : function ()
	{
		var obj_This = this;
		
		this.m_obj_Toolbar = Ext.create("Ext.toolbar.Toolbar",
		{
			width : 150,
			dock : 'right',
			cls : 'ux-start-menu-toolbar',
			vertical : true
		});
		
		this.m_obj_ToEnd = this.m_obj_Toolbar.add('->');
		this.m_obj_Sep = this.m_obj_Toolbar.add('-');
		
		this.m_obj_Logout = this.m_obj_Toolbar.add(
		{
			text : 'Logout',
			iconCls : 'menu-logout-icon',
			handler : function ()
			{
				desktop.MsgBus
						.fireEvent(desktop.MsgBus.self.C_STR_EVENT_LOGOUT);
			},
			scope : obj_This
		});
		
		this.m_obj_Toolbar.layout.align = 'stretch';
	},
	
	buildMenu : function ()
	{
		this.m_obj_Menu = Ext.create("Ext.menu.Menu",
		{
			cls : 'ux-start-menu-body',
			border : false,
			floating : false
		});
		
		this.m_obj_Menu.layout.align = 'stretch';
	},
	
	addToolItem : function ()
	{
		var cmp = this.m_obj_Toolbar;
		cmp.add.apply(cmp, arguments);
	},
	
	showBy : function (cmp, pos, off)
	{
		
		if (this.floating && cmp)
		{
			this.layout.autoSize = true;
			this.show();
			
			// Component or Element
			cmp = cmp.el || cmp;
			
			// Convert absolute to floatParent-relative
			// coordinates if
			// necessary.
			var xy = this.el.getAlignToXY(cmp, pos || this.defaultAlign, off);
			if (this.floatParent)
			{
				var r = this.floatParent.getTargetEl().getViewRegion();
				xy[0] -= r.x;
				xy[1] -= r.y;
			}
			this.showAt(xy);
			this.doConstrain();
		}
		return this;
	}
}); // StartMenu
