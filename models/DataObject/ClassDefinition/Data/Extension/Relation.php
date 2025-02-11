<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Model\DataObject\ClassDefinition\Data\Extension;

trait Relation
{
    /**
     * @param bool $asArray
     *
     * @return string[]
     *
     *@internal
     *
     */
    protected function getPhpDocClassString(bool $asArray = false): array
    {
        // init
        $class = [];
        $strArray = $asArray ? '[]' : '';

        // add documents
        if ($this->getDocumentsAllowed()) {
            $documentTypes = $this->getDocumentTypes();
            if (count($documentTypes) == 0) {
                $class[] = '\Pimcore\Model\Document\Page' . $strArray;
                $class[] = '\Pimcore\Model\Document\Snippet' . $strArray;
                $class[] = '\Pimcore\Model\Document' . $strArray;
            } elseif (is_array($documentTypes)) {
                foreach ($documentTypes as $item) {
                    $class[] = sprintf('\Pimcore\Model\Document\%s', ucfirst($item['documentTypes']) . $strArray);
                }
            }
        }

        // add asset
        if ($this->getAssetsAllowed()) {
            $assetTypes = $this->getAssetTypes();
            if (count($assetTypes) == 0) {
                $class[] = '\Pimcore\Model\Asset' . $strArray;
            } elseif (is_array($assetTypes)) {
                foreach ($assetTypes as $item) {
                    $class[] = sprintf('\Pimcore\Model\Asset\%s', ucfirst($item['assetTypes']) . $strArray);
                }
            }
        }

        // add objects
        if ($this->getObjectsAllowed()) {
            $classes = $this->getClasses();
            if (count($classes) === 0) {
                $class[] = '\Pimcore\Model\DataObject\AbstractObject' . $strArray;
            } elseif (is_array($classes)) {
                foreach ($classes as $item) {
                    $class[] = sprintf('\Pimcore\Model\DataObject\%s', ucfirst($item['classes']) . $strArray);
                }
            }
        }

        return $class;
    }

    /**
     * @return array[
     *  'classes' => string,
     * ]
     */
    public function getClasses(): array
    {
        return $this->classes ?: [];
    }

    /**
     * @return array[
     *  'assetTypes' => string,
     * ]
     */
    public function getAssetTypes(): array
    {
        return [];
    }

    /**
     * @return array[
     *  'documentTypes' => string,
     * ]
     */
    public function getDocumentTypes(): array
    {
        return [];
    }

    public function getDocumentsAllowed(): bool
    {
        return false;
    }

    public function getAssetsAllowed(): bool
    {
        return false;
    }

    public function getObjectsAllowed(): bool
    {
        return false;
    }
}
