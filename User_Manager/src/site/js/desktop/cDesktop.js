Ext
        .define(
                'darkowl.desktop.cDesktop',
                {
                    extend : 'Ext.panel.Panel',
                    alias : 'widget.desktop',
                    requires :
                    [ 'darkowl.desktop.layout.cFitAll',
                            'darkowl.desktop.cTaskbar',
                            'darkowl.desktop.cWallPaper',
                            'darkowl.desktop.cDesktopWindow' ],

                    uses :
                    [
                    // // 'Ext.util.MixedCollection',
                    'Ext.menu.Menu', 'Ext.view.View', // dataview
                    // // 'Ext.window.Window'
                    ],

                    m_obj_WindowMenu : null,
                    m_obj_Windows : null,
                    m_obj_Shortcut : null,
                    m_str_WallPaper : '',

                    activeWindowCls : 'ux-desktop-active-win',
                    inactiveWindowCls : 'ux-desktop-inactive-win',
                    lastActiveWindow : null,

                    border : false,
                    html : '&#160;',
                    layout : 'fitall',

                    xTickSize : 20,
                    yTickSize : 20,

                    // app: null,

                    /**
					 * @cfg {Array|Store} shortcuts The items to add to the
					 *      DataView. This can be a {@link Ext.data.Store Store}
					 *      or a simple array. Items should minimally provide
					 *      the fields in the
					 *      {@link Ext.ux.desktop.ShorcutModel ShortcutModel}.
					 */
                    shortcuts : null,

                    /**
					 * @cfg {String} shortcutItemSelector This property is
					 *      passed to the DataView for the desktop to select
					 *      shortcut items. If the {@link #shortcutTpl} is
					 *      modified, this will probably need to be modified as
					 *      well.
					 */
                    shortcutItemSelector : 'div.ux-desktop-shortcut',

                    /**
					 * @cfg {String} shortcutTpl This XTemplate is used to
					 *      render items in the DataView. If this is changed,
					 *      the {@link shortcutItemSelect} will probably also
					 *      need to changed.
					 */
                    shortcutTpl :
                    [
                            '<tpl for=".">',
                            '<div class="ux-desktop-shortcut" id="{name}-shortcut">',
                            '<div class="ux-desktop-shortcut-icon {iconCls}">',
                            '<img src="',
                            Ext.BLANK_IMAGE_URL,
                            '" title="{name}">',
                            '</div>',
                            '<span class="ux-desktop-shortcut-text">{name}</span>',
                            '</div>', '</tpl>', '<div class="x-clear"></div>' ],

                    initComponent : function()
                    {
	                    var obj_This = this;

	                    this.windows = Ext.create("Ext.util.MixedCollection");

	                    this.m_obj_WindowMenu = Ext.create("Ext.menu.Menu",
	                            this.createWindowMenu());

	                    this.m_obj_Taskbar = Ext.create(
	                            "darkowl.desktop.cTaskbar",
	                            {
	                                m_obj_WindowMenu : this.m_obj_WindowMenu,
	                                dock : "bottom"
	                            });

	                    obj_This.contextMenu = Ext.create("Ext.menu.Menu", this
	                            .createDesktopMenu());

	                    this.m_obj_WallPaper = Ext
	                            .create("darkowl.desktop.cWallPaper");

	                    this.m_obj_Shortcut = this.createDataView();

	                    this.items =
	                    [ this.m_obj_WallPaper, this.m_obj_Shortcut ];

	                    this.callParent();

	                    this.addDocked(this.m_obj_Taskbar);

	                    this.shortcutsView = obj_This.items.getAt(1);
	                    this.shortcutsView.on('itemclick',
	                            this.onShortcutItemClick, this);

	                    if (this.m_str_WallPaper)
	                    {
		                    this.setWallpaper(this.m_str_WallPaper,
		                            this.wallpaperStretch);
	                    }

	                    desktop.MsgBus.on(
	                            desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
	                            this.createWindow, this);
                    },
                    addShortcut : function(obj_Shortcuts)
                    {
	                    if (this.m_obj_Shortcut.store == null)
	                    {
		                    this.m_obj_Shortcut.store = obj_Shortcuts;
	                    }
	                    else
	                    {
		                    if (obj_Shortcuts)
		                    {
			                    obj_Shortcuts.each(function(obj_Record)
			                    {
				                    this.m_obj_Shortcut.store.add(obj_Record);
			                    }, this);
		                    }
	                    }

                    },
                    addQuickStart : function(obj_Data)
                    {
	                    this.m_obj_Taskbar.addQuickStart(obj_Data);
                    },
                    addStartMenu : function(obj_Data)
                    {
	                    this.m_obj_Taskbar.addStartMenu(obj_Data);
                    },
                    createDataView : function()
                    {
	                    var obj_Return = Ext
	                            .create(
	                                    'Ext.view.View',
	                                    {
	                                        overItemCls : 'x-view-over',
	                                        trackOver : true,
	                                        itemSelector : this.shortcutItemSelector,
	                                        store : Ext
	                                                .create(
	                                                        'Ext.data.Store',
	                                                        {
	                                                            fields : darkowl.desktop.module.abs_Module.C_ARR_FIELDS,
	                                                            proxy :
	                                                            {
	                                                                type : 'memory',
	                                                                reader :
	                                                                {
	                                                                    type : 'json',
	                                                                    root : 'items'
	                                                                }
	                                                            }
	                                                        }),
	                                        // this.shortcuts,
	                                        tpl : new Ext.XTemplate(
	                                                this.shortcutTpl)
	                                    });

	                    return obj_Return;
                    },

                    createDesktopMenu : function()
                    {
	                    var ret =
	                    {
		                    items : this.contextMenuItems || []
	                    };

	                    if (ret.items.length)
	                    {
		                    ret.items.push('-');
	                    }

	                    ret.items.push(
	                    {
	                        text : 'Tile',
	                        handler : this.tileWindows,
	                        scope : this,
	                        minWindows : 1
	                    },
	                    {
	                        text : 'Cascade',
	                        handler : this.cascadeWindows,
	                        scope : this,
	                        minWindows : 1
	                    })

	                    return ret;
                    },

                    createWindowMenu : function()
                    {
	                    var obj_This = this;
	                    var obj_Return =
	                    {
	                        defaultAlign : 'br-tr',
	                        items :
	                        [
	                        {
	                            text : 'Restore',
	                            handler : obj_This.onWindowMenuRestore,
	                            scope : obj_This
	                        },
	                        {
	                            text : 'Minimize',
	                            handler : obj_This.onWindowMenuMinimize,
	                            scope : obj_This
	                        },
	                        {
	                            text : 'Maximize',
	                            handler : obj_This.onWindowMenuMaximize,
	                            scope : obj_This
	                        }, '-',
	                        {
	                            text : 'Close',
	                            handler : obj_This.onWindowMenuClose,
	                            scope : obj_This
	                        } ],
	                        listeners :
	                        {
	                            beforeshow : this.onWindowMenuBeforeShow,
	                            hide : this.onWindowMenuHide,
	                            scope : this
	                        }
	                    };
	                    return obj_Return;

                    },
                    setWallpaper : function(str_Wallpaper, bool_Stretch)
                    {
	                    this.m_obj_WallPaper.setWallpaper(str_Wallpaper,
	                            bool_Stretch);
	                    return this;
                    },
                    onDesktopMenu : function(e)
                    {
	                    var obj_This = this, menu = obj_This.contextMenu;
	                    e.stopEvent();
	                    if (!menu.rendered)
	                    {
		                    menu.on('beforeshow',
		                            obj_This.onDesktopMenuBeforeShow, obj_This);
	                    }
	                    menu.showAt(e.getXY());
	                    menu.doConstrain();
                    },

                    onDesktopMenuBeforeShow : function(menu)
                    {
	                    var obj_This = this, count = obj_This.m_obj_Windows
	                            .getCount();

	                    menu.items.each(function(item)
	                    {
		                    var min = item.minWindows || 0;
		                    item.setDisabled(count < min);
	                    });
                    },

                    onShortcutItemClick : function(obj_DataView, obj_Record)
                    {
	                    if (obj_Record.get('onClick'))
	                    {
		                    obj_Record.get('onClick')();
	                    }
                    },

                    onWindowClose : function(win)
                    {
	                    var obj_This = this;
	                    obj_This.m_obj_Windows.remove(win);
	                    obj_This.m_obj_Taskbar.removeTaskButton(win.taskButton);
	                    obj_This.updateActiveWindow();
                    },

                    // ------------------------------------------------------
                    // Window context menu handlers
                    onWindowMenuBeforeShow : function(menu)
                    {
	                    var items = menu.items.items, win = menu.theWin;
	                    items[0].setDisabled(win.maximized !== true
	                            && win.hidden !== true); // Restore
	                    items[1].setDisabled(win.minimized === true); // Minimize
	                    items[2].setDisabled(win.maximized === true
	                            || win.hidden === true); // Maximize
                    },

                    onWindowMenuClose : function()
                    {
	                    var obj_This = this, win = obj_This.m_obj_WindowMenu.theWin;

	                    win.close();
                    },

                    onWindowMenuHide : function(menu)
                    {
	                    menu.theWin = null;
                    },

                    onWindowMenuMaximize : function()
                    {
	                    var obj_This = this, win = obj_This.m_obj_WindowMenu.theWin;

	                    win.maximize();
                    },

                    onWindowMenuMinimize : function()
                    {
	                    var obj_This = this, win = obj_This.m_obj_WindowMenu.theWin;

	                    win.minimize();
                    },

                    onWindowMenuRestore : function()
                    {
	                    var obj_This = this, win = obj_This.m_obj_WindowMenu.theWin;

	                    obj_This.restoreWindow(win);
                    },

                    // ------------------------------------------------------
                    // Dynamic (re)configuration methods

                    getWallpaper : function()
                    {
	                    return this.m_str_WallPaper.wallpaper;
                    },

                    setTickSize : function(xTickSize, yTickSize)
                    {
	                    var obj_This = this, xt = obj_This.xTickSize = xTickSize, yt = obj_This.yTickSize = (arguments.length > 1) ? yTickSize
	                            : xt;

	                    obj_This.m_obj_Windows.each(function(win)
	                    {
		                    var dd = win.dd, resizer = win.resizer;
		                    dd.xTickSize = xt;
		                    dd.yTickSize = yt;
		                    resizer.widthIncrement = xt;
		                    resizer.heightIncrement = yt;
	                    });
                    },

                    // ------------------------------------------------------
                    // Window management methods

                    cascadeWindows : function()
                    {
	                    var x = 0, y = 0, zmgr = this.getDesktopZIndexManager();

	                    zmgr.eachBottomUp(function(win)
	                    {
		                    if (win.isWindow && win.isVisible()
		                            && !win.maximized)
		                    {
			                    win.setPosition(x, y);
			                    x += 20;
			                    y += 20;
		                    }
	                    });
                    },

                    createWindow : function(obj_Config, str_Cls)
                    {
	                    var obj_This = this;
	                    var obj_Win;

	                    if (typeof str_Cls != "string")
	                    {
		                    str_Cls = null;
	                    }

	                    if (!obj_Config)
	                    {
		                    obj_Config =
		                    {
		                        stateful : false,
		                        isWindow : true,
		                        constrainHeader : true,
		                        minimizable : true,
		                        maximizable : true
		                    };
	                    }

	                    if (!str_Cls)
	                    {
		                    str_Cls = 'darkowl.desktop.cDesktopWindow';
	                    }

	                    obj_Win = this.add(Ext.create(str_Cls, obj_Config));
	                    if (this.m_obj_Windows.getCount())
	                    {
		                    var obj_Tmp = this.m_obj_Windows.last();
		                    var arr_Pos = obj_Tmp.getPosition(true);

		                    arr_Pos[0] += this.xTickSize;
		                    arr_Pos[1] += this.yTickSize;

		                    obj_Win.setPosition(arr_Pos[0], arr_Pos[1]);
	                    }

	                    this.m_obj_Windows.add(obj_Win);

	                    obj_Win.taskButton = this.m_obj_Taskbar
	                            .addTaskButton(obj_Win);
	                    obj_Win.animateTarget = obj_Win.taskButton.el;

	                    obj_Win.on(
	                    {
	                        activate : obj_This.updateActiveWindow,
	                        beforeshow : obj_This.updateActiveWindow,
	                        deactivate : obj_This.updateActiveWindow,
	                        minimize : obj_This.minimizeWindow,
	                        destroy : obj_This.onWindowClose,
	                        scope : obj_This
	                    });

	                    obj_Win
	                            .on(
	                            {
	                                afterrender : function()
	                                {
		                                obj_Win.dd.xTickSize = this.xTickSize;
		                                obj_Win.dd.yTickSize = this.yTickSize;

		                                if (obj_Win.resizer)
		                                {
			                                obj_Win.resizer.widthIncrement = this.xTickSize;
			                                obj_Win.resizer.heightIncrement = this.yTickSize;
		                                }
	                                },
	                                single : true
	                            }); // replace normal window close w/fadeOut
	                    animation: obj_Win.doClose = function()
	                    {
		                    obj_Win.el.disableShadow();
		                    obj_Win.el.fadeOut(
		                    {
			                    listeners :
			                    {
				                    afteranimate : function()
				                    {
					                    obj_Win.destroy();
				                    }
			                    }
		                    });
	                    };

	                    obj_Win.show();

	                    return obj_Win;
                    },

                    getActiveWindow : function()
                    {
	                    var win = null, zmgr = this.getDesktopZIndexManager();

	                    if (zmgr)
	                    {
		                    // We cannot rely on activate/deactive because that
		                    // fires
		                    // against
		                    // non-Window
		                    // components in the stack.

		                    zmgr.eachTopDown(function(comp)
		                    {
			                    if (comp.isWindow && !comp.hidden)
			                    {
				                    win = comp;
				                    return false;
			                    }
			                    return true;
		                    });
	                    }

	                    return win;
                    },

                    getDesktopZIndexManager : function()
                    {
	                    var m_obj_Windows = this.m_obj_Windows;
	                    // TODO - there has to be a better way to get this...
	                    return (m_obj_Windows.getCount() && m_obj_Windows
	                            .getAt(0).zIndexManager)
	                            || null;
                    },

                    getWindow : function(id)
                    {
	                    return this.m_obj_Windows.get(id);
                    },

                    minimizeWindow : function(win)
                    {
	                    win.minimized = true;
	                    win.hide();
                    },

                    restoreWindow : function(win)
                    {
	                    if (win.isVisible())
	                    {
		                    win.restore();
		                    win.toFront();
	                    }
	                    else
	                    {
		                    win.show();
	                    }
	                    return win;
                    },

                    tileWindows : function()
                    {
	                    var obj_This = this, availWidth = obj_This.body
	                            .getWidth(true);
	                    var x = obj_This.xTickSize, y = obj_This.yTickSize, nextY = y;

	                    obj_This.m_obj_Windows.each(function(win)
	                    {
		                    if (win.isVisible() && !win.maximized)
		                    {
			                    var w = win.el.getWidth();

			                    // Wrap to next row if we are not at the line
			                    // start and this
			                    // Window will
			                    // go off the end
			                    if (x > obj_This.xTickSize
			                            && x + w > availWidth)
			                    {
				                    x = obj_This.xTickSize;
				                    y = nextY;
			                    }

			                    win.setPosition(x, y);
			                    x += w + obj_This.xTickSize;
			                    nextY = Math.max(nextY, y + win.el.getHeight()
			                            + obj_This.yTickSize);
		                    }
	                    });
                    },

                    updateActiveWindow : function()
                    {
	                    var obj_This = this, activeWindow = obj_This
	                            .getActiveWindow(), last = obj_This.lastActiveWindow;
	                    if (activeWindow === last)
	                    {
		                    return;
	                    }

	                    if (last)
	                    {
		                    if (last.el.dom)
		                    {
			                    last.addCls(obj_This.inactiveWindowCls);
			                    last.removeCls(obj_This.activeWindowCls);
		                    }
		                    last.active = false;
	                    }

	                    obj_This.lastActiveWindow = activeWindow;

	                    if (activeWindow)
	                    {
		                    activeWindow.addCls(obj_This.activeWindowCls);
		                    activeWindow.removeCls(obj_This.inactiveWindowCls);
		                    activeWindow.minimized = false;
		                    activeWindow.active = true;
	                    }

	                    obj_This.m_obj_Taskbar.setActiveButton(activeWindow
	                            && activeWindow.taskButton);
                    }
                });