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

namespace Pimcore\Event;

final class TranslationEvents
{
    /**
     * @Event("Pimcore\Event\Model\TranslationEvent")
     *
     * @var string
     */
    const PRE_SAVE = 'pimcore.translation.preSave';

    /**
     * @Event("Pimcore\Event\Model\TranslationEvent")
     *
     * @var string
     */
    const POST_SAVE = 'pimcore.translation.postSave';

    /**
     * @Event("Pimcore\Event\Model\TranslationEvent")
     *
     * @var string
     */
    const PRE_DELETE = 'pimcore.translation.preDelete';

    /**
     * @Event("Pimcore\Event\Model\TranslationEvent")
     *
     * @var string
     */
    const POST_DELETE = 'pimcore.translation.postDelete';

    /**
     * @Event("Pimcore\Event\Model\TranslationXliffEvent")
     *
     * @var string
     */
    const XLIFF_ATTRIBUTE_SET_EXPORT = 'pimcore.translation.xliff.attribute_set_export';

    /**
     * @Event("Pimcore\Event\Model\TranslationXliffEvent")
     *
     * @var string
     */
    const XLIFF_ATTRIBUTE_SET_IMPORT = 'pimcore.translation.xliff.attribute_set_import';
}
