<?php

declare(strict_types=1);

/*
 * @copyright   2019 Mautic, Inc. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.com
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\IntegrationsBundle\Auth\Support\Oauth2\ConfigAccess;

use MauticPlugin\IntegrationsBundle\Auth\Provider\AuthConfigInterface;
use MauticPlugin\IntegrationsBundle\Auth\Support\Oauth2\Token\TokenFactoryInterface;

interface ConfigTokenFactoryInterface extends AuthConfigInterface
{
    public function getTokenFactory(): TokenFactoryInterface;
}
