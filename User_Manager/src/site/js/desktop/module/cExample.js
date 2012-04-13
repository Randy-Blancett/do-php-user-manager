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
			fields :
			[
					'name', 'iconCls'
			],
			data :
			{
				'items' :
				[
					{
						'name' : 'Example Shortcut',
						"iconCls" : "menu-action-view-icon"
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
	}
});