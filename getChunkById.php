<?php
/**
 * getChunkById MODX Revolution 2.x snippet
 *
 * Copyright 2012 Jiri Pavlicek <jiri@pavlicek.cz>
 *
 * @author Jiri Pavlicek <jiri@pavlicek.cz>
 * @version Version 1.0.0
 * 04/06/12
 *
 * getChunkById is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * getChunkById is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Redirecturls; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package getChunkById
 */

/**
 * MODx getChunkById snippet
 *
 * Install:
 * 1) create snippet "getChunkById"
 * 2) create default chunk, for example "topbannerdefault"
 * 3) cteate chunks for document IDs you need, for example "topbanner13", "topbanner14" and so on
 *
 * Description:
 * getChunkById snippet returns chunk for current document by ID or for parent documents of any level.
 *
 * Example: 
 * 1) insert snippet call in template: [[getChunkById? &ids=`13,14,15` &chunkBaseName=`topbanner` &defaultChunk=`topbannerdefault`]]
 * 2) snippet returns chunk "topbanner13" content for document ID 13 and for all childs of document ID 13
 * 3) snippet returns chunk "topbanner14" content for document ID 14 and for all childs of document ID 14
 * 4) snippet returns chunk "topbanner15" content for document ID 15 and for all childs of document ID 15
 * 5) snippet returns chunk "topbannerdefault" content for all other documents
 *
 * Tested od MODX revolution 2.2.0-pl2
 *
 * @package getChunkById
 *
 */

$id = $modx->resource->get('id');
$ids = explode(",", $ids);
$chunk = $defaultChunk;

while (($id != 0) && !in_array($id, $ids)) {

  $doc = $modx->getObject('modResource', array(
    'id' => $id
  ));
  $id = $doc->get('parent');
  
}

if ($id != 0) {
  $chunk = $chunkBaseName . $id;
}

return $modx->getChunk($chunk, $properties);