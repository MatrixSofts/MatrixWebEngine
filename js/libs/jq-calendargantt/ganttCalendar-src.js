/*
 * Gantt Calendar by Julien CORON - 2013
 * Copyright 2013 Julien CORON
 * 
 * Licence :
   Ce programme est un logiciel libre ; vous pouvez le redistribuer ou le 
   modifier suivant les termes de la GNU General Public License telle que 
   publiée par la Free Software Foundation ; soit la version 3 de la licence, 
   soit (à votre gré) toute version ultérieure.

   Ce programme est distribué dans l'espoir qu'il sera utile, mais SANS AUCUNE 
   GARANTIE ; pas même la garantie implicite de COMMERCIABILISABILITÉ ni 
   d'ADÉQUATION à UN OBJECTIF PARTICULIER. Consultez la GNU General Public 
   License pour plus de détails.
 * 
 * 
   This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/* TimeLineMonth - VERSION 1.1 */
TimeLineMonth = function(container, month, year, ressources, updateMonthCallback) {
	return this.init(container, month, year, ressources, updateMonthCallback);
};

$.extend(TimeLineMonth.prototype, {
	// object variables
	TimeLineClass: 'MONTH',
	container:'',
	month: '',
	year: '',
	days: {1:[31,31],2:[28,29],3:[31,31],4:[30,30],5:[31,31],6:[30,30],
		7:[31,31],8:[31,31],9:[30,30],10:[31,31],11:[30,30],12:[31,31]
	},
	lang: 'fr',
	months: {'fr':["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"],
		'en':["January", "February", "March", "April", "May", "June", "July", "Agust", "September", "October", "November", "December"]
	},
	weekDays: {'fr':["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
		'en':["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]
	},
	cellWidth: 20,
	ressourcesColumnHeader : 'Ressources',
	init: function(container, month, year, ressources, updateMonthCallback) {
		this.container = container;
		this.month = month;
		this.year = year;
		this.ressources = ressources;
		this.updateMonthCallback = updateMonthCallback || function(){};
		
		return this;
	},

	drawElements: function() {
		var containerObj, largeCalendar, monthLine, calendarHeaders, eventsContainer, headerRessources, 
			spanLabelCenter, listRessources, indexGroup, group, indexRessource,
			ressource, bisextile, horizontalCalendarContent, lineOfDays, htmlDays, 
			indexDay, day2digits;
		bisextile = ( (this.year%4==0 && this.year%100!=0) || this.year%400==0 )?(1):(0);

		containerObj = $("#"+this.container);
		containerObj.timeLineMonth = this;
		
		largeCalendar = $( document.createElement('div') ).addClass("largeCalendar");
		containerObj.html(largeCalendar);
		
		
		monthLine = $( document.createElement('div') ).addClass("month");
		largeCalendar.html(monthLine);
		monthLine.html("<div class=\"prevMonth\" title=\"[Page down] Go to Previous month\"></div>\
		<div class=\"nameMonth\">"+this.months[this.lang][this.month-1]+" "+this.year+"</div>\
		<div class=\"nextMonth\" id=\"nextMonth\" title=\"[Page up] Go to next month\"></div>");
		
		calendarHeaders = $( document.createElement('div') ).addClass("leftColumn horizontalCalendarHeaders");
		largeCalendar.append(calendarHeaders);
		
		eventsContainer = $( document.createElement('div') ).addClass("eventsContainer container-grid-"+this.cellWidth);
		largeCalendar.append(eventsContainer);
		
		headerRessources = $( document.createElement('div') ).addClass("headerRessources");
		calendarHeaders.html(headerRessources);

		/**
		 * ZOOM FEATURES -- BEGIN
		 */
		// update the size of eventsContainer to match with borders
		// set the default size for calculations
		containerObj.width( $(document).width() - 1);
		
		if(this.cellWidth*this.days[this.month][bisextile]+ headerRessources.width() + 3 < containerObj.width()){
			containerObj.width(this.cellWidth*this.days[this.month][bisextile] + headerRessources.width() + 3);
		}

		var widthForcontainer = largeCalendar.width() - headerRessources.width() - 1;
		if( this.cellWidth*this.days[this.month][bisextile] < widthForcontainer){
			widthForcontainer = this.cellWidth*this.days[this.month][bisextile];
		}
		eventsContainer.width(widthForcontainer);
		/**
		 * ZOOM FEATURES -- END
		 */
		
		spanLabelCenter = $( document.createElement('span') ).addClass("labelCenter").html(this.ressourcesColumnHeader);
		headerRessources.html(spanLabelCenter);
		
		listRessources = $( document.createElement('div') ).addClass("listRessources");
		calendarHeaders.append(listRessources);
		
		
		// All groups and ressources, prepare left side
		for(indexGroup=0;indexGroup<this.ressources.groups.length;indexGroup++){
			group = this.ressources.groups[indexGroup];
			listRessources.append("<div id=\"group_"+group.id+"\" class=\"group\">\
					<span class=\"labelLeft\">"+group.name+"</span>\
				</div>");
			
			for(indexRessource=0;indexRessource<group.ressources.length;indexRessource++){
				ressource = group.ressources[indexRessource];
				listRessources.append("<div id=\"ressource_"+ressource.id+"\" data-group=\"group_"+group.id+"\" class=\"ressource lineRessource\">\
					<span class=\"labelRight\">"+ressource.name+"</span>\
					</div>");
			}
		}
		
		horizontalCalendarContent = $( document.createElement('div') )
			.addClass("horizontalCalendarContent for"+this.days[this.month][bisextile]+"days")
			.attr("tabindex", "0");
		eventsContainer.append(horizontalCalendarContent);
		
		lineOfDays = $( document.createElement('div') ).addClass("lineOfDays");
		horizontalCalendarContent.html(lineOfDays);
		
		htmlDays = "";
		for(indexDay=1;indexDay<=this.days[this.month][bisextile];indexDay++){
			day2digits = (indexDay<10)?("0"+indexDay):(indexDay);
			jsDate = new Date(this.year, this.month -1, indexDay);
			htmlDays += "<div class=\"day weekdayorder_"+jsDate.getDay()+"\" id=\"day_"+day2digits+"\">"+
				day2digits+"<br/><span class=\"weekDay\">"+this.weekDays[this.lang][jsDate.getDay()]+"</span></div>";
		}
		lineOfDays.html(htmlDays);
		
		// All groups and ressources, prepare content
		firstDayOfMonth = new Date(this.year, this.month -1, 1);
		for(indexGroup=0;indexGroup<this.ressources.groups.length;indexGroup++){
			group = this.ressources.groups[indexGroup];
			horizontalCalendarContent.append("<div data-group=\"group_"+group.id+"\" class=\"group\">&nbsp;</div>");
			
			for(indexRessource=0;indexRessource<group.ressources.length;indexRessource++){
				ressource = group.ressources[indexRessource];
				horizontalCalendarContent.append("<div class=\"lineForRessource grid-"+this.cellWidth+"-offset-"+ firstDayOfMonth.getDay() +"\" data-ressource=\"ressource_"+ressource.id+"\" id=\"events_r_"+ressource.id+"\"></div>");
			}
		}
		
		this.defineEvents(this);
	},
	
	goToNextMonth: function(){
		if(this.month == 12){
			this.month = 1;
			this.year++;
		} else{
			this.month++;
		}
		this.drawElements();
		this.updateMonthCallback();
	},
	
	goToPrevMonth: function(){
		if(this.month == 1){
			this.month = 12;
			this.year--;
		} else{
			this.month--;
		}
		this.drawElements();
		this.updateMonthCallback();
	},
	
	updateWidth: function() {
		$(".eventsContainer").width($(".largeCalendar").width() - $(".headerRessources").width() - 1);
	},
	
	defineEvents: function($calendarObject){
		
		$(".prevMonth").click(function () {
			$calendarObject.goToPrevMonth();
		});

		$(".nextMonth").click(function () {
			$calendarObject.goToNextMonth();
		});
		
		$(".horizontalCalendarContent").keydown(function(event) {	   
			switch(event.keyCode) {
				case 34: // PAGE_DOWN
					$calendarObject.goToPrevMonth();
					$(".horizontalCalendarContent").focus();
					break;
				case 33: //PAGE_UP
					$calendarObject.goToNextMonth();
					$(".horizontalCalendarContent").focus();
					break;
				default:
					break;
			};
		});
		
		$(window).resize(function() {
			$calendarObject.drawElements();
			$calendarObject.updateMonthCallback();
		});

	}
	
});

Event = function(ressourceId, eventId, startDay, endDay, label) {
	  this.init(ressourceId, eventId, startDay, endDay, label);
};

$.extend(Event.prototype, {
	// object variables
	ressourceId: '',
	eventId: '',
	startDay: '',
	endDay: '',
	label: '',
	jObject: null,
	
	init: function(ressourceId, eventId, startDay, endDay, label) {
		this.ressourceId = ressourceId;
		this.eventId = eventId;
		this.startDay = startDay;
		this.endDay = endDay;
		this.label = label;
	},

	drawIn: function(containerObject) {
		var margin=0, width=0, newStartDay, newEndDay;
		containerId = containerObject.container;
		if(containerObject.TimeLineClass ==  'MONTH'){
			margin = containerObject.cellWidth * (this.startDay - 1);
			width = containerObject.cellWidth * (this.endDay - this.startDay) - 3;
		}else if(containerObject.TimeLineClass == 'WEEK'){
			newStartDay = this.startDay - containerObject.mondayOfWeek.getDate();
			newEndDay = this.endDay - containerObject.mondayOfWeek.getDate();
			margin = containerObject.cellWidth * (newStartDay);
			width = containerObject.cellWidth * (newEndDay - newStartDay) - 3;
		}
		
		
		$("#"+containerId).find("#events_r_"+this.ressourceId).append('<div id="'+this.eventId+'" class="event" style="left: '+margin+'px;width:'+width+'px;">'+this.label+'</div>');
		this.jObject = $("#"+this.eventId);
		$("#"+containerId).find("#"+this.eventId).draggable({ axis: "x", containment: "parent", opacity: 0.5, snap: true });
		$("#"+containerId).find("#events_r_"+this.ressourceId).droppable({
			drop: function(event, ui){
				var containerLeft, eventLeft, newDayStart;
				containerLeft = $(this).offset().left;
				eventLeft = ui.offset.left;
				newDayStart = 1 + ((eventLeft - containerLeft) / containerObject.cellWidth); // px
				$(".debug").html("newDayStart: "+  newDayStart );
			}
		});
		return this; 
	}
});


/* TimeLineWeek - VERSION 0.1 */
TimeLineWeek = function(container, weekNumber, year, ressources, updateWeekCallback) {
	return this.init(container, weekNumber, year, ressources, updateWeekCallback);
};


$.extend(TimeLineWeek.prototype, {
	// object variables
	TimeLineClass: 'WEEK',
	container:'',
	weekNumber: '',
	year: '',
	lang: 'fr',
	weekDays: {'fr':["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
		'en':["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]
	},
	cellWidth: 20,
	mondayOfWeek: null,
	sundayOfWeek: null,
	ressourcesColumnHeader : 'Ressources',
	init: function(container, weekNumber, year, ressources, updateWeekCallback) {
		this.container = container;
		this.weekNumber = weekNumber;
		this.year = year;
		this.ressources = ressources;
		this.updateWeekCallback = updateWeekCallback || function(){};
		
		return this;
	},

	drawElements: function() {
		var containerObj, largeCalendar, weekLine, calendarHeaders, eventsContainer, headerRessources, 
			spanLabelCenter, listRessources, indexGroup, group, indexRessource,
			ressource, bisextile, horizontalCalendarContent, lineOfDays, htmlDays, 
			indexDay, day2digits;
		bisextile = ( (this.year%4==0 && this.year%100!=0) || this.year%400==0 )?(1):(0);
		var firstDayOfYear = new Date(this.year, 0, 1);
		var milisecondsOffset = 1000 * 60 * 60 * 24 * 7 * (this.weekNumber - 1);
		var targetTime = firstDayOfYear.getTime() + milisecondsOffset - 86400000;
		this.mondayOfWeek = new Date(targetTime);
		this.sundayOfWeek = new Date(targetTime); 
		this.sundayOfWeek.setDate(this.mondayOfWeek.getDate() + 6);

		containerObj = $("#"+this.container);
		containerObj.timeLineMonth = this;
		
		largeCalendar = $( document.createElement('div') ).addClass("largeCalendar");
		containerObj.html(largeCalendar);
		
		
		weekLine = $( document.createElement('div') ).addClass("week");
		largeCalendar.html(weekLine);
		weekLine.html("<div class=\"prevWeek\" title=\"[Page down] Go to Previous week\"></div>\
		<div class=\"nameWeek\"> "+this.weekDays[this.lang][1]+" "+this.mondayOfWeek.toLocaleDateString(this.lang)+" - "
			+this.weekDays[this.lang][0]+" "+ this.sundayOfWeek.toLocaleDateString(this.lang) +"</div>\
		<div class=\"nextWeek\" id=\"nextWeek\" title=\"[Page up] Go to next week\"></div>");
		
		calendarHeaders = $( document.createElement('div') ).addClass("leftColumn horizontalCalendarHeaders");
		largeCalendar.append(calendarHeaders);
		
		eventsContainer = $( document.createElement('div') ).addClass("eventsContainer container-grid-"+this.cellWidth+" forWeek");
		largeCalendar.append(eventsContainer);
		
		headerRessources = $( document.createElement('div') ).addClass("headerRessources");
		calendarHeaders.html(headerRessources);

		/**
		 * ZOOM FEATURES -- BEGIN
		 */
		// update the size of eventsContainer to match with borders
		// set the default size for calculations
		//containerObj.width( this.cellWidth*7 + headerRessources.width() + 3 );
		containerObj.width( $(document).width() - 1);
		
		if(this.cellWidth*7 + headerRessources.width() + 3 < containerObj.width()){
			containerObj.width(this.cellWidth*7 + headerRessources.width() + 3);
		}

		var widthForcontainer = largeCalendar.width() - headerRessources.width() - 1;
		if( this.cellWidth*7 < widthForcontainer){
			widthForcontainer = this.cellWidth*7;
		}
		eventsContainer.width(widthForcontainer);
		
		/**
		 * ZOOM FEATURES -- END
		 */
		
		spanLabelCenter = $( document.createElement('span') ).addClass("labelCenter").html(this.ressourcesColumnHeader);
		headerRessources.html(spanLabelCenter);
		
		listRessources = $( document.createElement('div') ).addClass("listRessources");
		calendarHeaders.append(listRessources);
		
		
		// All groups and ressources, prepare left side
		for(indexGroup=0;indexGroup<this.ressources.groups.length;indexGroup++){
			group = this.ressources.groups[indexGroup];
			listRessources.append("<div id=\"group_"+group.id+"\" class=\"group\">\
					<span class=\"labelLeft\">"+group.name+"</span>\
				</div>");
			
			for(indexRessource=0;indexRessource<group.ressources.length;indexRessource++){
				ressource = group.ressources[indexRessource];
				listRessources.append("<div id=\"ressource_"+ressource.id+"\" data-group=\"group_"+group.id+"\" class=\"ressource lineRessource\">\
					<span class=\"labelRight\">"+ressource.name+"</span>\
					</div>");
			}
		}
		
		horizontalCalendarContent = $( document.createElement('div') )
			.addClass("horizontalCalendarContent")
			.attr("tabindex", "0")
			.width(this.cellWidth*7);
		eventsContainer.append(horizontalCalendarContent);
		
		lineOfDays = $( document.createElement('div') ).addClass("lineOfDays");
		horizontalCalendarContent.html(lineOfDays);
		
		htmlDays = "";
		var currentDay = new Date(this.mondayOfWeek.getTime());
		// loop on 7 days
		for(indexDay=1;indexDay<=7;indexDay++){
			day2digits = (currentDay.getDate()<10)?("0"+currentDay.getDate()):(currentDay.getDate());
			htmlDays += "<div class=\"day weekdayorder_"+currentDay.getDay()+"\" id=\"day_"+day2digits+"\">"+
				day2digits+"<br/><span class=\"weekDay\">"+this.weekDays[this.lang][indexDay%7]+"</span></div>";
			currentDay.setDate(currentDay.getDate() + 1);
		}
		lineOfDays.html(htmlDays);
		
		// All groups and ressources, prepare content
		firstDayOfWeek = new Date(this.mondayOfWeek.getTime());
		for(indexGroup=0;indexGroup<this.ressources.groups.length;indexGroup++){
			group = this.ressources.groups[indexGroup];
			horizontalCalendarContent.append("<div data-group=\"group_"+group.id+"\" class=\"group\">&nbsp;</div>");
			
			for(indexRessource=0;indexRessource<group.ressources.length;indexRessource++){
				ressource = group.ressources[indexRessource];
				horizontalCalendarContent.append("<div class=\"lineForRessource grid-"+this.cellWidth+"-offset-"+ 1/*firstDayOfWeek.getDay()*/ +"\" data-ressource=\"ressource_"+ressource.id+"\" id=\"events_r_"+ressource.id+"\"></div>");
			}
		}
		
		this.defineEvents(this);
	},
	
	goToNextWeek: function(){
		if(this.month == 12){
			this.month = 1;
			this.year++;
		} else{
			this.month++;
		}
		this.drawElements();
		this.updateMonthCallback();
	},
	
	goToPrevWeek: function(){
		if(this.month == 1){
			this.month = 12;
			this.year--;
		} else{
			this.month--;
		}
		this.drawElements();
		this.updateMonthCallback();
	},
	
	updateWidth: function() {
		$(".eventsContainer").width($(".largeCalendar").width() - $(".headerRessources").width() - 1);
	},
	
	defineEvents: function($calendarObject){
		
		$(".prevWeek").click(function () {
			$calendarObject.goToPrevWeek();
		});

		$(".nextWeek").click(function () {
			$calendarObject.goToNextWeek();
		});
		
		$(".horizontalCalendarContent").keydown(function(event) {	   
			switch(event.keyCode) {
				case 34: // PAGE_DOWN
					$calendarObject.goToPrevWeek();
					$(".horizontalCalendarContent").focus();
					break;
				case 33: //PAGE_UP
					$calendarObject.goToNextWeek();
					$(".horizontalCalendarContent").focus();
					break;
				default:
					break;
			};
		});
		
		$(window).resize(function() {
			$calendarObject.drawElements();
			$calendarObject.updateWeekCallback();
		});

	}
	
});