Ext.define('darkowl.desktop.cTaskbar',
{
	extend : 'Ext.toolbar.Toolbar', // TODO - make this a basic
	// hbox
	// panel...
	
	requires :
	[
			'darkowl.desktop.cWindowBar', 'darkowl.desktop.cStartMenu',
			'darkowl.desktop.cQuickStart',
			'darkowl.desktop.sysTray.cTrayClock',

			'Ext.button.Button', 'Ext.resizer.Splitter', 'Ext.menu.Menu',
			"Ext.toolbar.Toolbar"
	],
	// // uses:
	// // [
	// // 'DarkOwl.User_Manager.Desktop.SysTray.cTrayClock',
	// // ],
	
	alias : 'widget.taskbar',
	
	cls : 'ux-taskbar',
	
	/**
	 * @cfg {String} startBtnText The text for the Start Button.
	 */
	startBtnText : 'Start',
	
	initComponent : function ()
	{
		var obj_This = this;
		
		this.buildStartMenu();
		this.m_obj_QuickStart = Ext.create('darkowl.desktop.cQuickStart');
		this.buildWindowBar();
		this.buildTray();
		
		this.items =
		[
				{
					xtype : 'button',
					cls : 'ux-start-button',
					menu : this.m_obj_StartMenu,
					menuAlign : 'bl-tl',
					text : this.startBtnText
				}, obj_This.m_obj_QuickStart,
				{
					xtype : 'splitter',
					html : '&#160;',
					cls : 'x-toolbar-separator x-toolbar-separator-horizontal'
				}, '-', this.m_obj_WindowBar, '-', obj_This.m_obj_Tray
		];
		
		obj_This.callParent();
	},
	
	buildStartMenu : function ()
	{
		var obj_This = this;
		
		this.m_obj_StartMenu = Ext.create('darkowl.desktop.cStartMenu',
		{
			iconCls : 'menu-user-icon',
			title : darkowl.desktop.config.cConfig.getUserName()
		});
	},
	
	buildTray : function ()
	{
		this.m_obj_Tray = Ext.create("Ext.toolbar.Toolbar",
		{
			width : 80,
			items :
			[
					Ext.create("darkowl.desktop.sysTray.cTrayClock",
					{
						flex : 1
					}),
			]
		});
	},
	
	buildWindowBar : function ()
	{
		this.m_obj_WindowBar = Ext.create('darkowl.desktop.cWindowBar');
	},
	
	afterLayout : function ()
	{
		var obj_This = this;
		this.callParent();
		this.m_obj_WindowBar.el.on('contextmenu', obj_This.onButtonContextMenu,
				obj_This);
	},
	
	getWindowBtnFromEl : function (el)
	{
		var c = this.m_obj_WindowBar.getChildByElement(el);
		return c || null;
	},
	
	onQuickStartClick : function (btn)
	{
		var module = this.app.getModule(btn.module);
		if (module)
		{
			module.createWindow();
		}
	},
	
	onButtonContextMenu : function (e)
	{
		var obj_This = this, t = e.getTarget(), btn = obj_This
				.getWindowBtnFromEl(t);
		if (btn)
		{
			e.stopEvent();
			obj_This.m_obj_WindowMenu.theWin = btn.win;
			obj_This.m_obj_WindowMenu.showBy(t);
		}
	},
	
	onWindowBtnClick : function (btn)
	{
		var win = btn.win;
		
		if (win.minimized || win.hidden)
		{
			win.show();
		}
		else if (win.active)
		{
			win.minimize();
		}
		else
		{
			win.toFront();
		}
	},
	
	addTaskButton : function (obj_Win)
	{
		var obj_TaskWindow = Ext.create("Ext.button.Button",
		{
			iconCls : obj_Win.iconCls,
			enableToggle : true,
			toggleGroup : 'all',
			width : 140,
			text : Ext.util.Format.ellipsis(obj_Win.title, 20),
			// listeners: {
			// click: this.onWindowBtnClick,
			// scope: this
			// },
			win : obj_Win
		});
		/*
		 * var config = { iconCls: win.iconCls, enableToggle: true, toggleGroup:
		 * 'all', width: 140, text: Ext.util.Format.ellipsis(win.title, 20),
		 * listeners: { click: this.onWindowBtnClick, scope: this }, win: win };
		 */
		var cmp = this.m_obj_WindowBar.add(obj_TaskWindow);
		cmp.toggle(true);
		return cmp;
	},
	
	removeTaskButton : function (btn)
	{
		var found, obj_This = this;
		obj_This.m_obj_WindowBar.items.each(function (item)
		{
			if (item === btn)
			{
				found = item;
			}
			return !found;
		});
		if (found)
		{
			obj_This.m_obj_WindowBar.remove(found);
		}
		return found;
	},
	
	setActiveButton : function (btn)
	{
		if (btn)
		{
			btn.toggle(true);
		}
		else
		{
			this.m_obj_WindowBar.items.each(function (item)
			{
				if (item.isButton)
				{
					item.toggle(false);
				}
			});
		}
	},
	addStartMenu : function (obj_Menu)
	{
		this.m_obj_StartMenu.addStartMenu(obj_Menu);
	},
	addQuickStart : function (obj_QuickStart)
	{
		if (obj_QuickStart != null)
		{
			obj_QuickStart.each(function (obj_Record)
			{
				this.m_obj_QuickStart.add(
				{
					tooltip :
					{
						text : obj_Record.get("name"),
						align : 'bl-tl'
					},
					overflowText : obj_Record.get("name"),
					iconCls : obj_Record.get("iconCls"),
					handler : obj_Record.get("onClick")
				});
			}, this);
			
			this.m_obj_QuickStart.size_Box();
		}
	}
});
