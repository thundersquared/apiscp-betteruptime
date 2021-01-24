# Better Uptime integration for ApisCP

This extensions provides an implementation for ApisCP to fetch network status from Better Uptime.

## Make it work

1. Clone and install this extension.
   ```
   cd /usr/local/apnscp
   sudo -u apnscp mkdir -p extensions
   sudo -u apnscp git clone https://github.com/thundersquared/apiscp-betteruptime.git extensions/apiscp-betteruptime
   cd extensions/apiscp-betteruptime
   sudo -u apnscp composer install
   ```
2. Set your status page URL, key and page ID.
   ```
   cpcmd scope:set cp.config misc sys_status 'https://status.domain.com/'
   ```
3. Wait for Apache to reload and check out your panel.

## Updating

Just a copy-pasta:
```
cd /usr/local/apnscp/extensions/apiscp-betteruptime
sudo -u apnscp git pull
sudo -u apnscp composer update
```
