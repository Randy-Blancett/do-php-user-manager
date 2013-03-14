
Ext.define('darkowl.desktop.layout.cFitAll',
{
	extend : 'Ext.layout.container.AbstractFit',
	alias : 'layout.fitall',
	
	// @private
	onLayout : function ()
	{
		var obj_This = this;
		obj_This.callParent();
		
		var size = obj_This.getLayoutTargetSize();
		
		obj_This.owner.items.each(function (item)
		{
			obj_This.setItemBox(item, size);
		});
	},
	
	getTargetBox : function ()
	{
		return this.getLayoutTargetSize();
	},
	
	setItemBox : function (item, box)
	{
		var obj_This = this;
		if (item && box.height > 0)
		{
			if (obj_This.isManaged('width') === true)
			{
				box.width = undefined;
			}
			if (obj_This.isManaged('height') === true)
			{
				box.height = undefined;
			}
			
			item.getEl().position('absolute', null, 0, 0);
			obj_This.setItemSize(item, box.width, box.height);
		}
	}
});