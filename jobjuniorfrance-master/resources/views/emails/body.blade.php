<table class="pc-email-body" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
    style="table-layout: fixed;">
    <tbody>
        <tr>
            <td class="pc-email-body-inner" align="center" valign="top">
                <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" src="" color="#f4f4f4"/>
                </v:background>
                <![endif]-->
                <!--[if (gte mso 9)|(IE)]><table width="620" align="center" border="0" cellspacing="0" cellpadding="0" role="presentation"><tr><td width="620" align="center" valign="top"><![endif]-->
                <table class="pc-email-container" width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
                    role="presentation" style="margin: 0 auto; max-width: 620px;">
                    <tbody>
                        <tr>
                            <td align="left" valign="top" style="padding: 0 10px;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                    <tbody>
                                        <tr>
                                            <td height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                    <tbody>
                                        <tr>
                                            <td height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
                                    <tbody>
                                        <tr>
                                            <td class="pc-sm-p-30-30-40 pc-xs-p-15-20-25" valign="top" bgcolor="#ffffff"
                                                style="padding: 30px 40px 40px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1)">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                    role="presentation">
                                                    <tbody>
                                                        <tr>
                                                            <td height="20" style="font-size: 1px; line-height: 1px;">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </tbody>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 500; line-height: 10spx; letter-spacing: -0.4px; color: #151515;"
                                                            valign="top" align="center">
                                                            Les derniers jobs pour junior !
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
                                                            Hello developpeur(se),</td>

                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
                                                            J'espère que tout le monde va bien et que ça code dur !
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
                                                            Sache que si tu en marres d'attendre cette newsletter, tu
                                                            peux dorénavant t'abonner au twitter qui relaie en temps
                                                            réel les nouvelles offres du board :)
                                                            <a
                                                                href="https://twitter.com/devwebjuniorfr">@devwebjuniorfr</a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 500; line-height: 10spx; letter-spacing: -0.4px; color: #151515;"
                                                            valign="top" align="center">
                                                            <a href="https://developpeurwebjunior.fr"
                                                                style="text-decoration:underline; color:#336EFF">Le Job
                                                                Board</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 500; line-height: 10spx; letter-spacing: -0.4px; color: #151515;"
                                                            valign="top" align="left">
                                                            <br>

                                                            <br>
                                                            @foreach($jobs as $city => $cityJob)

                                                            <h4>{{$city}}</h4>
                                                            @foreach($cityJob as $job)
                                                            <ul>
                                                                <li style="margin-bottom:10px">
                                                                    <span
                                                                        style="font-size: 13px;">({{config('contracts')[$job->type]['type']}})</span>
                                                                    <a href="{{$job->slug ?? 'https://developpeurwebjunior.fr'}}"
                                                                        style="color:#336EFF">{{ $job->title }}
                                                                    </a>

                                                                    <br>
                                                                </li>
                                                            </ul>
                                                            @endforeach
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pc-fb-font"
                                                            style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 500; line-height: 10spx; letter-spacing: -0.4px; color: #151515;"
                                                            valign="top" align="left">
                                                            <br>
                                                            <p>N'hésitez pas à me contacter pour avoir des informations,
                                                                un avis sur un CV, lettre de motivation ou même un
                                                                soucis technique !</p>
                                                            <p>Par email: nicolas@developpeurwebjunior.fr</p>
                                                            <p>Ou via le discord de la communauté ! : <a
                                                                    href="https://discord.gg/V8wSyFR"
                                                                    style="text-decoration:underline; color:#336EFF">https://discord.gg/V8wSyFR</a>
                                                            </p>
                                                            <p>Si tu ne veux plus recevoir ces emails : <a
                                                                    href="{{route('home.get.unsubscribe', ['token' => $token])}}">clique
                                                                    ici !</a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pc-fb-font"
                                                style="font-family: 'Fira Sans', Helvetica, Arial, sans-serif; font-size: 15px; font-weight: 300; line-height: 28px; letter-spacing: -0.2px; color: #9B9B9B; bgcolor=#ffffff valign="
                                                top" align="center">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>