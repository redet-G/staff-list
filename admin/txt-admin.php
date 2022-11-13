<?php
function abcfsl_txta( $id, $suffix='' ) {

    $out = '';
    switch ($id){  
        case 0:
            break;       
        case 1:
            $out = __('Help', 'staff-list');
            break;
        case 2:
            $out = __('Images', 'staff-list');
            break;
        case 3:
            $out = 'Shortcode';
            break;
        case 4:
            $out = __('Uninstall', 'staff-list');
            break;
        case 5:
            $out = __('Yes', 'staff-list');
            break;
        case 6:
            $out = __('No', 'staff-list');
            break;
        case 7:
            $out = __('Default', 'staff-list');
            break;
        case 8:
            $out = __('License', 'staff-list');
            break;
        case 9:
            $out = __('Options', 'staff-list');
            break;
        case 10:
            $out = __('Font Size', 'staff-list');
            break;
//------------------------
       case 11:
            $out = __('Documentation', 'staff-list');
            break;
       case 12:
            $out = __('Admin', 'staff-list');
            break;
       case 13:
            $out = __('Layout', 'staff-list');
            break;
        case 14:
            $out = __('Width', 'staff-list');
            break;
        case 15:
            $out = __('Top Margin', 'staff-list');
            break;
        case 16:
            $out = __('Left Margin', 'staff-list');
            break;
        case 17:
            $out = __('Template Name', 'staff-list');
            break;
        case 18:
            $out = __('Template to Convert', 'staff-list');
            break;
        case 19:
            $out = 'Template Options';
            break;
//------------------------
        case 20:
            $out = __('Custom', 'staff-list');
            break;
        case 21:
             $out = __('Activate Key', 'staff-list');
             break;
        case 22:
             $out = 'Image';
             break;
        case 23:
            $out = __('Add Defaults', 'staff-list');
            break;
        case 24:
            $out = __('Support', 'staff-list');
            break;
        case 25:
            $out = __('Caption', 'staff-list');
            break;
        case 26:
            $out = __('License & Help', 'staff-list');
            break;
        case 27:
            $out = __('Image', 'staff-list');
            break;
        case 28:
            $out = __('Description', 'staff-list');
            break;
        case 29:
            $out = __('Title', 'staff-list');
            break;
//------------------------
        case 30:
            $out = __('Template Converter', 'staff-list');
            break;
        case 31:
            $out = __('Item Inner Container', 'staff-list');
            break;
        case 32:
            $out = __('Error', 'staff-list');
            break;
        case 33:
            $out = __('Default Template', 'staff-list');
            break;
        case 34:
            $out = __('Save Changes', 'staff-list');
            break;
        case 35:
            $out = __('Image ID', 'staff-list');
            break;
        case 36:
            $out = __('Pagination', 'staff-list');
            break;
        case 37:
            $out = __('Records per Page', 'staff-list');
            break;
        case 38:
            $out = 'Single Line Text';
            break;
        case 39:
            $out = __('Custom Text', 'staff-list');
             break;
//------------------------
        case 40:
            $out = __('Border', 'staff-list');
             break;
        case 41:
            $out = __('Underline', 'staff-list');
            break;
        case 42:
            $out = __('Highlight', 'staff-list');
            break;
       case 43:
            $out = __('Text', 'staff-list');
            break;
       case 44:
            $out = __('None', 'staff-list');
            break;
        case 45:
            $out = __('Items', 'staff-list');
            break;
        case 46:
            $out = __('Menu Items Left/Right Margins', 'staff-list');
            break;
        case 47:
            $out = __('Font', 'staff-list');
            break;
        case 48:
            $out = __('Container Width', 'staff-list');
            break;
        case 49:
            $out = __('Center Items', 'staff-list');
            break;
//------------------------
        case 50:
            $out = __('Menu Items Page', 'staff-list');
            break;
        case 51:
            $out = __('Number of Columns', 'staff-list');
            break;
        case 52:
            $out = __('Social Icons', 'staff-list');
            break;
        case 53:
            $out = __('Show Links', 'staff-list');
            break;
        case 54:
            $out = __('Social Media Links (Icons)', 'staff-list');
            break;
        case 55:
            $out = __('Icons', 'staff-list');
            break;
        case 56:
            $out = __('Utilities', 'staff-list');
            break;
        case 57:
            $out = 'Staff Categories'; //Main menu
            break;
        case 58:
            $out = 'Structured Data';
            break;
        case 59:
            $out = 'Social Icons';
            break;
//------------------------
        case 60:
            $out = __('Manual', 'staff-list');
            break;
        case 61:
            $out = 'Sort Text';
            break;
        case 62:
            $out = __('Custom Link', 'staff-list');
            break;
        case 63:
            $out = 'Staff Template';
            break;
        case 64:
            $out = 'Field Order - Staff Page';
            break;
        case 65:
            $out = __('Filter', 'staff-list');
            break;
        case 66:
             $out = __('Filter Type', 'staff-list');
            break;
        case 67:
            $out = __('AZ Filter', 'staff-list');
            break;
        case 68:
            $out = __('Staff Page', 'staff-list');
            break;
        case 69:
            $out = __('Single Page', 'staff-list');
            break;
//------------------------
        case 70:
            $out = __('Staff Page + Single Page', 'staff-list');
            break;
        case 71:
            $out = __('Hide/Delete', 'staff-list');
            break;
        case 72:
            $out = __('Show On', 'staff-list');
            break;
        case 73:
            $out = 'Text Editor';
            break;
        case 74:
            $out = __('Text Link to Single Page', 'staff-list');
            break;
        case 75:
            $out = __('Left-Right Margins', 'staff-list');
            break;
        case 76:
            $out = __('Hide', 'staff-list');
            break;
        case 77:
            $out = __('Page Title', 'staff-list');
            break;
        case 78:
            $out = __('Quick Start', 'staff-list');
            break;
        case 79:
            $out = __('Custom', 'staff-list');
            break;
//------------------------
        case 80:
            $out = __('Create a Staff Template and 3 Staff Member records.', 'staff-list');
            break;
        case 81:
            $out = __('Text Style', 'staff-list');
            break;
        case 82:
            $out = 'Hyperlink';
            break;
        case 83:
            $out = __('Center Container', 'staff-list');
            break;
        case 84:
            $out = __('Center Image Horizontally', 'staff-list');
            break;
        case 85:
            $out = __('Default: 1%', 'staff-list');
            break;
        case 86:
            $out = 'Paragraph Text';
            break;
        case 87:
            $out = __('When images start loading.', 'staff-list');
            break;
        case 88:
            $out = __('Menu Container', 'staff-list');
            break;
        case 89:
            $out = __('Bottom Margin', 'staff-list');
            break;
//------------------------
        case 90:
            $out = __('Menu Item', 'staff-list');
            break;
        case 91:
            $out = __('Font Color', 'staff-list');
            break;
        case 92:
            $out = __('Active Item Decoration', 'staff-list');
            break;
        case 93:
            $out = __('Uppercase', 'staff-list');
            break;
        case 94:
            $out = __('Convert Template to a New Layout.', 'staff-list');
            break;
        case 95:
            $out = __('Label - All Records', 'staff-list');
            break ;
        case 96:
            $out = __('Category Slugs', 'staff-list');
            break;
        case 97:
            $out = __('Gray', 'staff-list');
            break;
        case 98:
            $out = __('Dark Gray', 'staff-list');
            break;
        case 99:
            $out = __('Black', 'staff-list');
            break;
//------------------------
        case 100:
            $out = 'Pagination';
            break;
        case 101:
            $out = __('Valid data entry formats for Width or Margins: 15, 15px, 15%, 1em. Blank (no entry) = default value.', 'staff-list');
            break;
        case 104:
            $out = __('Default: 100%.', 'staff-list');
            break;
        case 106:
            $out = __('Default: 100%, of the parent container.', 'staff-list');
            break;
        case 107:
            $out = __('Default: 0 (zero pixels).', 'staff-list');
             break;
        case 109:
            $out = __('Blank (no entry) = default value.', 'staff-list');
            break ;
//------------------------
        case 110:
            $out = __('Converts one template layout to another layout.', 'staff-list');
            break; 
        case 111:
            $out = __('Examples: <strong>All, Any</strong>', 'staff-list');
            break ;
        case 112:
            $out = __('Category Page URL', 'staff-list');
            break ;
        case 113:
            $out = 'AZ Menu';
            break ;
        case 114:
            $out = __('Add category slugs. Category names will show up as item names.', 'staff-list');
            break ;
        case 115:
            $out = __('Shortcode Parameter', 'staff-list');
            break ;
        case 116:
            $out = __('Image left, text right.', 'staff-list');
            break ;
        case 117:
            $out = __('Comma delimited list of single characters. Displayed as items and used as filters. Example: A,B,C,D,E,F,G', 'staff-list');
            break;
        case 118:
            $out = __('Grid Container', 'staff-list');
            break ;
        case 119:
            $out = __('Container Left-Right Margins', 'staff-list');
            break;
//------------------------
        case 120:
            $out = __('Container Bottom Margin', 'staff-list');
            break;
        case 121:
            $out = __('Part', 'staff-list');
            break;
        case 122:
            $out = __('Order - Staff', 'staff-list');
            break;
        case 123:
            $out = __('Order - Single', 'staff-list');
            break;
        case 124:
            $out = __('Staff Page - Prefix/Suffix', 'staff-list');
            break;
        case 125:
            $out = __('Field Options', 'staff-list');
            break;
        case 126:
            $out = __('Field parts are separated with a space. Use suffix option to add commas or other separators.', 'staff-list');
            break;
        case 127:
            $out = __('Example: <strong>Profile, Bio, Detail, More...</strong>', 'staff-list');
            break;
        case 128:
            $out = __('Multipart Field', 'staff-list');
            break;
        case 129:
            $out = __('Field to Search', 'staff-list');
            break;
//------------------------
        case 130:
            $out = __('Field Style - Single Page', 'staff-list');
            break;
        case 131:
            $out = __('Labels & Filters', 'staff-list');
            break;
        case 132:
            $out = __('Control Size', 'staff-list');
            break;
        case 133:
            $out = __('What field to use for a search.', 'staff-list');
            break;
        case 134:
            $out = __('Hide = Keep data, don\'t display field on the front end.', 'staff-list');
            break;
        case 135:
            $out = __('After all images are loaded.', 'staff-list');
            break;
        case 136:
            $out = __('Add Script: Images Loaded', 'staff-list');
            break;
        case 137:
            $out = __('Show All as a last item.', 'staff-list');
            break;
        case 138:
            $out = __('Random', 'staff-list');
            break;
        case 139:
            $out = __('Field Style - Staff Page', 'staff-list');
            break;
//--------------------------------
        case 140:
            $out = __('Field Location on a Single Page', 'staff-list');
            break;
        case 141:
            $out = __('Text Link Style', 'staff-list');
            break;
        case 142:
            $out = __('Links to Single Page', 'staff-list');
            break;
        case 143:
            $out = __('Open in a new tab or window.', 'staff-list');
            break;
        case 144:
            $out = __('Two columns. Image left, text right.', 'staff-list');
            break;
        case 145:
            $out = __('Middle Section', 'staff-list');
            break;
        case 146:
            $out = 'Grid B';
            break;
        case 147:
            $out = __('Show Link', 'staff-list');
            break;
        case 148:
            $out = __('Disregard if field is not selected to show up on a Single Page.', 'staff-list');
            break;
        case 149:
            $out = __('Color Schema', 'staff-list');
            break;
//--------------------------------
        case 150:
            $out = 'Abbreviated';
            break;
        case 151:
            $out = __('Hide Filter', 'staff-list');
            break;
        case 152:
            $out = __('Categories', 'staff-list');
            break;
        case 153:
            $out = __('Hide Record (do not show up at the front end).', 'staff-list');
            break;
        case 154:
            $out = __('Large', 'staff-list');
            break;
        case 155:
            $out = __('Medium', 'staff-list');
            break;
        case 156:
            $out = __('Small', 'staff-list');
            break;
        case 157:
            $out = __('Extra Small', 'staff-list');
            break;
        case 158:
            $out = __('Left', 'staff-list');
            break;
        case 159:
            $out = __('Center', 'staff-list');
            break;
//--------------------------------
        case 160:
            $out = __('Right', 'staff-list');
            break;
        case 161:
            $out = __('Number of Page Links', 'staff-list');
            break;
        case 162:
            $out = __('Help Text', 'staff-list');
            break;
        case 163:
            $out = __('Alignment', 'staff-list');
            break;
        case 164:
            $out = __('Top', 'staff-list');
            break;
        case 165:
            $out = __('Bottom', 'staff-list');
            break;
        case 166:
            $out = __('Location', 'staff-list');
            break;
        case 167:
            $out = __('Blue', 'staff-list');
            break;
        case 168:
            $out = __('No Records Found Message', 'staff-list');
            break;
        case 169:
            $out = __('Decolorize', 'staff-list');
            break;
//--------------------------------
        case 170:
            $out = 'Shortcodes';
            break;
        case 171:
            $out = __('Delete Filter', 'staff-list');
            break;
        case 172:
            $out = __('Image Placeholders', 'staff-list');
            break;
        case 173:
            $out = __('Default Placeholder', 'staff-list');
            break;
        case 174:
            $out = __('Single Field Search', 'staff-list');
            break;
        case 175:
            $out = __('Circular Image', 'staff-list');
            break;
        case 176:
            $out = __('Records are filtered by the first letter of the search field content.', 'staff-list');
            break;
        case 177:
            $out = __('Custom Placeholders', 'staff-list');
            break;
        case 178:
            $out = __('Labels', 'staff-list');
            break;
        case 179:
            $out = __('Property Name', 'staff-list');
            break;
//--------------------------------
        case 180:
            $out = __('Structured Data', 'staff-list');
            break;
        case 181:
            $out = __('Type Name', 'staff-list');
            break;
        case 182:
            $out = 'Static Text';
            break;
        case 183:
            $out = __('Value', 'staff-list');
            break;
        case 184:
            $out = __('Embeded Item', 'staff-list');
            break;
        case 185:
            $out = __('Linked Fields', 'staff-list');
            break;
        case 186:
            $out = __('ALT Tag', 'staff-list');
            break;
        case 187:
            $out = __('Shortcode options.', 'staff-list');
            break;
        case 188:
            $out = __('Field Parts Order', 'staff-list');
            break;
        case 189:
            $out = __('Sort Text field', 'staff-list');
            break;
//--------------------------------
        case 190:
            $out = __('Copy from Single Line Text field', 'staff-list');
            break;
        case 191:
            $out = __('Copy from Name - Multipart Field', 'staff-list');
            break;
        case 192:
            $out = 'Isotope';
            break;
        case 193:
            $out = __('List Items', 'staff-search');
            break;
        case 194:
            $out = __('Menu Items', 'staff-list');
            break;
        case 195:
            $out = __('Menu Label', 'staff-list');
            break;
        case 196:
            $out = __('How to add menu to a page.', 'staff-list');
            break;
        case 197:
            $out = __('Image Left/Right Margins', 'staff-list');
            break;
        case 198:
            $out = __('Link Attributes', 'staff-list');
            break;
        case 199:
            $out = __('Link onClick JS', 'staff-list');
            break;
//--------------------------------
        case 200:
            $out = __('Email link requires two input fields: <b>Text</b>  and <b>Email Adress</b>. The Text is the visible part displayed on the page.', 'staff-list');
            break;
        case 201:
            $out = 'Grid A';
            break;
        case 202:
            $out = __('Containers', 'staff-list');
            break;
        case 203:
            $out = __('Default: Social Media Links (Icons)', 'staff-list');
            break;
        case 204:
            $out = __('Templates', 'staff-list');
            break;
        case 205:
            $out = __('Field Label (Link Text)', 'staff-list');
            break;
        case 206:
            $out = 'Static Label (inline) + Text';
            break;
        case 207:
            $out = __('This template has no social links activated.', 'staff-list');
            break;
        case 208:
            $out = __('Field Label', 'staff-list');
            break;
        case 209:
            $out = __('Field Description', 'staff-list');
            break;
//--------------------------------
        case 210:
            $out = __('Single Staff Member page is optional.', 'staff-list');
            break;
        case 211:
            $out = __('Field Container Style', 'staff-list');
            break;
        case 212:
            $out = __('What type of content the field will contain: text, hyperlink, email etc.', 'staff-list');
            break;
        case 213:
             $out = __('Template Layout', 'staff-list');
            break;
        case 214:
            $out = __('Template has no fields.', 'staff-list');
            break;
        case 215:
            $out = 'List';
            break;
        case 216:
            $out = __('Custom Icons', 'staff-list');
            break;
        case 217:
            $out = 'Input Fields';
            break;
        case 218:
            $out = __('Darken', 'staff-list');
            break;
        case 219:
            $out = __('Enter the URL of social media accounts.', 'staff-list');
            break;
//--------------------------------
        case 220:
            $out = __('Image top, text bottom.', 'staff-list');
            break;
        case 221:
            $out = __('Supports HTML tags.', 'staff-list');
            break;
        case 222:
            $out = __('Field Type', 'staff-list');
            break;
        case 223:
            $out = __('To override the default styles.', 'staff-list');
            break;
        case 224:
            $out = __('The CSS style you would like to use in order to override the default styles for this field.', 'staff-list');
            break;
        case 225:
            $out = __('Lighten', 'staff-list');
            break;
        case 226:
            $out = __('Static Label Style', 'staff-list');
            break;
        case 227:
            $out = __('Text displayed on top of the data entry form.', 'staff-list');
            break;
        case 228:
            $out = __('Staff Images', 'staff-list');
            break;
        case 229:
            $out = __('Static Label + Hyperlink', 'staff-list');
            break;
//--------------------------------
        case 230:
            $out = __('Hyperlink requires two fields: <b>Text</b>  and <b>URL</b>. Text is the visible part. The URL specifies the destination address of the link.', 'staff-list');
            break;
        case 231:
            $out = '"Pretty" Permalink';
            break;
        case 232:
            $out = __('Person name or any other text. Example: <b>john-smith</b>. No spaces!', 'staff-list');
            break;
        case 233:
            $out = __('Select on what page type the field will show up.', 'staff-list');
            break;
        case 234:
            $out = 'Drop-Down List';
            break;
        case 235:
            $out = __('Set up how and what data is displayed on Staff and Single Staff pages.', 'staff-list');
            break;
        case 236:
            $out = __('Enter an icon name. It has to match exactly the custom icon name.', 'staff-list');
            break;
        case 237:
            $out = __('Drop-Down List', 'staff-list');
            break;
        case 238:
            $out = __('Icons Container Style', 'staff-list');
            break;
        case 239:
            $out = __('Form Title', 'staff-list');
            break;
//--------------------------------
        case 240:
            $out = __('Category Filter', 'staff-list');
            break;
        case 241:
            $out = __('Create Records', 'staff-list');
            break;
        case 242:
             $out = __('How to publish staff page.', 'staff-list');
            break;
        case 243:
            $out = __('Tilt', 'staff-list');
            break;
        case 244:
            $out = __('Select Template', 'staff-list');
            break;
        case 245:
            $out = __('Field Description (Link Text)', 'staff-list');
            break;
        case 246:
            $out = __('Drop Shadow', 'staff-list');
            break;
        case 247:
            $out = __('Default = your theme\'s font.', 'staff-list');
            break;
        case 248:
            $out = __('Visual Assistance', 'staff-list');
            break;
        case 249:
            $out = __('Show a wireframe to assist with laying out content.', 'staff-list');
            break;
//--------------------------------
        case 250:
            $out = __('Item Columns - Width', 'staff-list');
            break;
        case 251:
            $out = __('Text Container', 'staff-list');
            break;
        case 252:
            $out = __('Default: <b>abcfslPadLPc5</b> (padding left 5%)', 'staff-list');
            break;
        case 253:
            $out = __('Left/Right Panels - Width', 'staff-list');
            break;
        case 254:
            $out = __('Default: Padding top 5%.', 'staff-list');
            break;
        case 255:
            $out = __('Simply drag the items up or down and they will be saved in that order.', 'staff-list');
            break;
        case 256:
            $out = 'Hyperlink with Static Text';
            break;
        case 257:
            $out = __('Optional. Provide the user some direction on how the field should be filled out.', 'staff-list');
            break;
        case 258:
            $out = __('Hyperlink Style', 'staff-list');
            break;
        case 259:
            $out = __('Link Text', 'staff-list');
            break;
//--------------------------------
        case 260:
            $out = __('Optional. Default: 100%. Valid formats: px, %. Example: 15px, 15%. No entry = default value.', 'staff-list');
            break;
        case 261:
            $out = __('Image Link', 'staff-list');
            break;
        case 262:
            $out = __('Global settings (Template - Single Page Options). Custom URL can overwrite some of the global settings', 'staff-list');
            break;
        case 263:
            $out = __('Select Image', 'staff-list');
            break;
        case 264:
            $out = __('Text to display as link text.', 'staff-list');
            break;
        case 265:
            $out = __('Animations on Hover', 'staff-list');
            break;
        case 266:
            $out = __('No list items found. There maybe no items or none of the existing items is linked to this template.', 'staff-list');
            break;
        case 267:
            $out = __('Swiching templates may cause loss of data.', 'staff-list');
            break;
        case 268:
            $out = __('Staff Member Data', 'staff-list');
            break;
        case 269:
            $out = __('First Item Value', 'staff-list');
            break;
//--------------------------------
        case 270:
            $out = __('Optional.', 'staff-list');
            break;
        case 271:
            $out = __('Single Page URL', 'staff-list');
            break;
        case 272:
            $out = __('First Item Text', 'staff-list');
            break;
        case 273:
            $out = __('Overlay', 'staff-list');
            break;
        case 274:
            $out = 'Drop-Down List + Static Label';
            break;
        case 275:
            $out = __('Static Label');
            break;
        case 276:
            $out = 'Category Menu';
            break;
        case 277:
            $out = __('Filters Container', 'staff-list');
            break;
        case 278:
            $out = __('Text Container Width = Image Width', 'staff-list');
            break;
        case 279:
            $out = __('Field container HTML tag. Default = DIV.', 'staff-list');
            break;
//--------------------------------
        case 280:
            $out = 'Staff Order';
            break;
        case 281:
            $out = __('Staff Members are listed in alphabetical order by the Sort Text field.', 'staff-list');
            break;
        case 282:
            $out = __('This is the field title (label) the user will see when filling out the form.', 'staff-list');
            break;
        case 283:
            $out = __('Search Button', 'staff-list');
            break;
        case 284:
            $out = __('To use the same image for Staff Page and Single Page enter <span class="abcflFontW700">SP</span>.', 'staff-list');
            break;
        case 285:
            $out = __('Top Section', 'staff-list');
            break;
        case 286:
            $out = __('Field Display Options', 'staff-list');
            break;
        case 287:
            $out = __('Field HTML Tag', 'staff-list');
            break;
        case 288:
            $out = __('Demo', 'staff-list');
            break;
        case 289:
            $out = __('Custom Inline Style', 'staff-list');
            break;
//--------------------------------
        case 290:
            $out = 'Email';
            break;
        case 291:
            $out = __('Field ID', 'staff-list');
            break;
        case 292:
            $out = __('How to add shortcode parameter to the shortcode.', 'staff-list');
            break;
        case 293:
            $out = __('Displayed inline, next to the field value.', 'staff-list');
            break;
        case 294:
            $out = __('Demo Records', 'staff-list');
            break;
        case 295:
            $out = __('To horizontally center container when width < 100%.', 'staff-list');
            break;
        case 296:
            $out = __('Lock the field to prevent accidental changes.', 'staff-list');
            break;
        case 297:
            $out = __('Field Locked. Editing disabled.', 'staff-list');
            break;
        case 298:
            $out = __('All requred options have to be selected.', 'staff-list');
            break;  
        case 299:
            $out = __('Convert to ...', 'staff-list');
            break;
//--------------------------------
        case 300:
            $out = __('Field Label (Email Adress)', 'staff-list');
            break;
        case 301:
            $out = __('Item Container', 'staff-list');
            break;
        case 302:
            $out = __('Field Label (URL)', 'staff-list');
            break;
        case 303:
            $out = __('Single Page SEO Options', 'staff-list');
            break;
        case 304:
            $out = __('Menu', 'staff-list');
            break;
        case 305:
            $out = __('Getting Started', 'staff-list');
            break;
        case 306:
            $out = __('Label Text', 'staff-list');
            break;
        case 307:
            $out = __('Default: 40 pixels.', 'staff-list');
            break;
        case 308:
            $out = __('Hide link to Single Page.', 'staff-list');
            break;
        case 309:
            $out = __('Optional. Text container can span the width of the column or be limited to width of the image.', 'staff-list');
            break;
//--------------------------------
        case 310:
            $out = __('Staff Page Image', 'staff-list');
            break;
        case 311:
            $out = __('Single Page Image', 'staff-list');
            break;
        case 312:
            $out = __('Image URL', 'staff-list');
            break;
        case 313:
            $out = 'Name - Multipart Field';
            break;
        case 314:
            $out = __('The number of columns in a row.', 'staff-list');
            break;
        case 315:
             $out = __('Bottom Section', 'staff-list');
            break;
         case 316:
            $out = __('Filter Controls', 'staff-list');
            break;
        case 317:
            $out = __('Field Description (URL)', 'staff-list');
            break;
        case 318:
            $out = __('Field Description (Email Address)', 'staff-list');
            break;
        case 319:
            $out = __('Input Field Labels', 'staff-list');
            break;
//--------------------------------
        case 320:
            $out = __('Add a New Field', 'staff-list');
            break;
        case 321:
            $out = __('Delete Field', 'staff-list');
            break;
        case 322:
            $out = __('Displays a single staff member.', 'staff-list');
            break;
        case 323:
            $out = __('Custom CSS Class', 'staff-list');
            break;
        case 324:
            $out = 'Horizontal Line';
            break;
        case 325:
            $out = __('Single Page Shortcode', 'staff-list');
            break;
        case 326:
            $out = __('How to create and publish single page.', 'staff-list');
            break;
        case 327:
            $out = __('You can\'t delete this template. It\'s used by one or more staff members.', 'staff-list');
            break;
        case 328:
            $out = __('Display email address as plain text.', 'staff-list');
            break;
        case 329:
            $out = __('How link Staff page to a Single Page.', 'staff-list');
            break;
//--------------------------------
        case 330:
            $out = __('Sort Text Field - Data Entry Options', 'staff-list');
            break;
        case 331:
            $out = __('Manual entry', 'staff-list');
            break;
        case 332:
            $out = __('Staff Order', 'staff-list');
            break;
        case 333:
            $out = __('Update the shortcode (on staff page) after template conversion!', 'staff-list');
            break;            
        case 334:
            $out = __('Single Page - Prefix/Suffix', 'staff-list');
            break;
        case 335:
            $out = __('Sort Option', 'staff-list');
            break;
        case 336:        
            $out = __('Field Display Order - Staff/Single Pages', 'staff-list');
            break;
        case 337:
            $out = __('Email with Static Text', 'staff-list');
            break;
        case 338:
            $out = __('Button Color', 'staff-list');
            break;
        case 339:
            $out = __('Text to display as mailto hyperlink.', 'staff-list');
            break;
//--------------------------------
        case 340:
            $out = __('Group by categories.', 'staff-list');
            break;
        case 341:
            $out = __('Group by text.', 'staff-list');
            break;
        case 342:
            $out = __('Group by first letter A-Z.', 'staff-list');
            break;
        case 343:
            $out = __('Type of Grouping', 'staff-list');
            break;  
        case 344:
            $out = 'Staff Page - Layout';
            break;
        case 345:
            $out = 'Staff Page - Containers';
            break;            
        case 346:
            $out = 'Single Page - Layout';
            break;
        case 347:
            $out = 'Single Page - Options';
            break;
        case 348:
            $out = 'Field Order - Single Page';
            break;
        case 349:
            $out = __('Staff Page Shortcode', 'staff-list');
            break;               
//--------------------------------
        case 350:
            $out = __('Staff Template', 'staff-list'); 
            break;
        case 351:
            $out = __('Screen Min Width:', 'staff-list');
            break;
        case 352: 
            $out = 'Drop-Down Group';
            break;
        case 353: 
            $out = 'Overlay Options';
            break;
        case 354:
            $out = __('Text 1', 'staff-list');
            break;
        case 355:
            $out = __('Text 2', 'staff-list');
            break;
        case 356:
            $out = __('Text 2 Top Margin', 'staff-list');
            break;            
        case 357:
            $out = 'This field type has been discontinued and will be removed in a future!';
            break;
        case 358:
            $out = 'Please replace with: Template Options > Single Page > <strong>Single Page Text Link</strong>.';
            break;
        case 359:
            $out = __('Template', 'staff-list'); 
            break;
//--------------------------------            
        case 360:
            $out = __('Order', 'staff-list'); 
            break;    
        case 361:
            $out = __('Group Names', 'staff-list');
            break;
        case 362:
            $out = __('Group Letters', 'staff-list');
            break;
        case 363:
            $out = __('Field to group by.', 'staff-list');
            break;
        case 364:
            $out = __('Group Name Container', 'staff-list');
            break;
        case 365:
            $out = __('Group Name', 'staff-list');
            break;
        case 366:
            $out = __('Number of Dropdowns', 'staff-list');
            break;            
        case 367:
            $out = __('Custom CSS', 'staff-list');
            break;
        case 368:
            $out = __('Field Container', 'staff-list');
            break;
        case 369:
            $out = __('Field Text', 'staff-list');
            break;
//--------------------------------
        case 370:
            $out = __('Sort Ouput Alphabetically', 'staff-list');
            break;
        case 371:
            $out = __('Locale', 'staff-list');
            break;
        case 372:
            $out = __('Optional. Displayed inline, next to the field value.', 'staff-list');
            break;
        case 373:
            $out = __('How to add grouping to staff list page.', 'staff-list');
            break;
        case 374:
            $out = __('CSS class name(s) to override the default styles.', 'staff-list');
            break;
        case 375: 
            $out = 'Checkbox Group';
            break;          
        case 376:
            $out = __('Checkbox Values', 'staff-list');
            break;
        case 377:
            $out = __('Use the same image for Staff Page and Single Page', 'staff-list');
            break;
        case 378:
            $out = __('Add link to staff image (image hyperlink).', 'staff-list');
            break;
        case 379:
            $out = __('Image Defaults', 'staff-list');
            break; 
//--------------------------------            
        case 380:
            $out = __('Disable wpautop', 'staff-list');
            break; 
        case 381:
            $out = __('Phone + Static Label', 'staff-list');
            break;
        case 382:
            $out = __('Field Label - Number to Dial (href)', 'staff-list');
            break;
        case 383:
            $out = __('Field Label - Visible Text', 'staff-list');
            break;
        case 384:
            $out = __('Post Title', 'staff-list');
            break; 
        case 385:
            $out = __('Months', 'staff-list');
            break;  
        case 386:
            $out = __('Database Version', 'staff-list');
            break;
        case 387:
            $out = __('WordPress Version', 'staff-list');
            break;  
        case 388:
            $out = __('Month Names', 'staff-list');
            break; 
        case 389:
            $out = __('Why my single page is blank?', 'staff-list');
            break; 
//--------------------------------         
        case 390:
            $out = __('Static Label + Date', 'staff-list');
            break; 
        case 391:
            $out = __('Image Container - Top Margin', 'staff-list');
            break; 
        case 392:
            $out = __('Image Caption - Font', 'staff-list');
            break; 
        case 393:
            $out = __('Image Caption - Top Margin', 'staff-list');
            break; 
        case 394:
            $out = __('Optional. Read only field. Provide some description.', 'staff-list');
            break;
        case 395:
            $out = __('Date Display Format', 'staff-list');
            break;
        case 396:
            $out = 'Grid C';
            break; 
        case 397:
            $out = 'No images.';
            break;  
        case 398:
            $out = 'Grid D';
            break;                       
        case 399:
            $out = 'No images, no single page';
            break;  
//-------------------------------- 
        case 400:
            $out = 'Page Container';
            break;
        case 401:
            $out = __('Image Container - Top Margin', 'staff-list');
            break; 
        case 402:
            $out = 'Page Layout';
            break; 
        case 403:
            $out = __('Icon Tag', 'staff-list');
            break;  
        case 404:
            $out = __('Max Number of Icons', 'staff-list');
            break;  
        case 405:
            $out = __('Class - Icon On', 'staff-list');
            break;  
        case 406:
            $out = __('Class - Icon Off', 'staff-list');
            break;  
        case 407:
            $out = __('Style - Icon On', 'staff-list');
            break;  
        case 408:
            $out = __('Style - Icon Off', 'staff-list');
            break;  
        case 409:
            $out = 'Icon Options';
            break;
//-------------------------------- 
        case 410:
            $out = __('vCard Template', 'staff-list');
            break;
        case 411:
            $out = __('Address - Multipart Field', 'staff-list');
            break;
        case 412:
            $out = __('Hide photo', 'staff-list');
            break;
        case 413:
            $out = __('Hide address', 'staff-list');
            break;
        case 414:
            $out = __('Hide URL 1', 'staff-list');
            break;
        case 415:
            $out = __('Hide vCard link', 'staff-list');
            break;
        case 416:
            $out = __('vCard plugin not installed!', 'staff-list');
            break;                                                                             
        case 417:
            $out = __('Street Address', 'staff-list');
            break;
        case 418:
            $out = __('Extended Address (apartment or suite number)', 'staff-list');
            break;
        case 419:
            $out = __('City (locality)', 'staff-list');
            break;
//--------------------------------             
        case 420:
            $out = __('State (region, province)', 'staff-list');
            break;  
        case 421:
            $out = __('Zipcode (postal code)', 'staff-list');
            break; 
        case 422:
            $out = __('Country Name', 'staff-list');
            break; 
        case 423:
            $out = __('State', 'staff-list');
            break; 
        case 424:
            $out = __('Zipcode', 'staff-list');
            break; 
        case 425:
            $out = __('Country', 'staff-list');
            break; 
        case 426:
            $out = __('City', 'staff-list');
            break; 
        case 427:
            $out = __('Apartment, suite number', 'staff-list');
            break; 
        case 428:
            $out = __('vCard Hyperlink', 'staff-list');
            break; 
        case 429:
            $out = __('vCard template not selected.', 'staff-list');
            break; 
//--------------------------------
        case 430:
            $out = __('vCard template not found.', 'staff-list');
            break;
        case 431:
            $out = __('Add download attribute.', 'staff-list');
            break;
        case 432:
            $out = __('QR Files Upload Directory', 'staff-list');
            break;                                  
        case 433:
            $out = __('QR Files URL', 'staff-list');
            break;
        case 434:
            $out = __('QR File Name', 'staff-list');
            break;
        case 435:
            $out = __('QR Code Hyperlink (Base64 static). Discontinued.', 'staff-list');
            break;
        case 436:
            $out = __('QR Code Hyperlink (Base64 dynamic). Discontinued.', 'staff-list');
            break; 
        case 437:
            $out = __('Yes, link to custom (static) pages.', 'staff-list');
            break;
        case 438:
            $out = __('Image Attributes', 'staff-list');
            break;  
        case 439:
            $out = __('Custom CSS Class - Text Container', 'staff-list');
            break;            
//--------------------------------              
        case 440:
            $out = __('Custom Inline Style - Text Container', 'staff-list');
            break; 
        case 441:
            $out = __('QR Code Image Base64 Static', 'staff-list');
            break; 
        case 442:
            $out = __('Dynamic image.', 'staff-list');
            break; 
        case 443:
            $out = __('Static Caption', 'staff-list');
            break;  
        case 444:
            $out = __('Static Alt', 'staff-list');
            break;   
        case 445:
            $out = __('Dynamic Caption', 'staff-list');
            break;   
        case 446:
            $out = __('Dynamic Alt', 'staff-list');
            break;
        case 447:
            $out = __('QR Code Image Base64 Dynamic', 'staff-list');
            break;   
        case 448:
            $out = __('Image Hyperlink + Caption', 'staff-list');
            break;               
        case 449:
            $out = __('Image + Caption', 'staff-list');
            break; 
//--------------------------------                        
        case 450:
            $out = __('Copy from Address - Multipart Field', 'staff-list');
            break;            
        case 451:
            $out = __('Documentation Isotope', 'staff-list');
            break;            
        case 452:
            $out = __('How to center text.', 'staff-list');
            break;     
        case 453:
            $out = __('Create link to a single page.', 'staff-list');
            break;
        case 454:
            $out = __('Saved as.', 'staff-list');
            break;
        case 456:
            $out = __('Plugin Updates', 'staff-list');
            break;  
        case 457:
            $out = __('Check for plugin updates', 'staff-list');
            break;                                                
        case 458:
            $out = __('Changelog', 'staff-list');
            break;          
//--------------------------------             
        case 500:
            $out = 'Show Off Icons';
            break; 
        case 501:
            $out = __('Icon Class', 'staff-list');
            break;
        case 502:
            $out = __('Icon Name', 'staff-list');
            break;
        case 503:
            $out = __('Icon Style', 'staff-list');
            break;  
        case 504:
            $out = __('Icon Spacing (Horizontal)', 'staff-list');
            break; 
        case 505:
            $out = __('Excluded Slugs', 'staff-list');
            break;  
        case 506:
            $out = __('Icon Type', 'staff-list');
            break; 
        case 507:
            $out = __('No Records Found', 'staff-list');
            break; 
        case 508:
            $out = __('Field Order', 'staff-list');
            break;
        case 509:
            $out = __('Field Parts Order the same as:', 'staff-list');
            break; 
//--------------------------------                              
        case 600:
            $out = __('Source of Data', 'staff-list');
            break; 
        case 601:
            $out = __('Custom class or style is required.', 'staff-list');
            break;  
        case 602:
            $out = __('Field container class.', 'staff-list');
            break;            
        case 603:
            $out = __('Field container style.', 'staff-list');
            break;
        case 604:
            $out = __('Static label class.', 'staff-list');
            break;  
        case 605:
            $out = __('Static label style.', 'staff-list');
            break;
        case 606:
            $out = __('Text class.', 'staff-list');
            break;  
        case 607:
            $out = __('Text style.', 'staff-list');
            break;
        case 608:
            $out = __('Spacer', 'staff-list');
            break; 
        case 609:
            $out = __('Staff template not selected!', 'staff-list');
            break; 
//--------------------Yes, link to static or hybrid pages.------------
        case 700:
            $out = __('Yes, link to hybrid pages.', 'staff-list');
            break;
        case 701:
            $out = 'Static Label (above) + Text';
            break;
        case 702:
            $out = __('Static Label Style - Single Page', 'staff-list');
            break;
        case 703:
            $out = __('Text Style - Single Page', 'staff-list');
            break;
        case 704:
            $out = __('Displayed above the field value container.', 'staff-list');
            break; 
        case 705:
            $out = __('Single Page Options', 'staff-list');
            break;  
        case 706:
            $out = __('', 'staff-list');
            break;
        case 707:
            $out = 'Static Label + Paragraph Text';
            break;
        case 708:
            $out = __('Top Margin - Single Page', 'staff-list'); 
            break;
        case 709:
            $out = __('Custom Styles', 'staff-list'); 
            break;            
//--------------------------------                              
        case 800:
            $out = __('Field Container CSS Class', 'staff-list');
            break;
        case 801:
            $out = __('Static Label CSS Class', 'staff-list');
            break; 
        case 802:
            $out = __('Text CSS Class', 'staff-list');
            break; 
        case 803:
            $out = __('Static Label Style - Staff Page', 'staff-list');
            break;  
        case 804:
            $out = __('Text Style - Staff Page', 'staff-list');
            break;
        case 805:
            $out = __('Field Style', 'staff-list');
            break;
        case 806:
            $out = __('Top Margin - Staff Page', 'staff-list'); 
            break; 
        case 807:
            $out = __('Label and optional description to identify the input fields. For staff member data entry screen only, not front end.', 'staff-list');
            break;             
        case 899:
            $out = __('', 'staff-list');
            break;
//--------------------------------             
            case 900:
                $out = __('', 'staff-list');
                break;
        default:
            break;
    }
    return $out . $suffix;
}

function abcfsl_txta_r( $id, $suffix='' ) {
    $txt = abcfsl_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}

function abcfsl_txta_txt_r( $txt ) {
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}

function abcfsl_txta_txt_red( $id, $suffix='' ) {
    $txt = abcfsl_txta( $id, $suffix );
    return '<span class="abcflRed abcflFontS18">'. $txt .'</span>';
}

