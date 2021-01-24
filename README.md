# Better Uptime integration for ApisCP

This extensions provides an implementation for ApisCP to fetch network status from Better Uptime.

## Install

1. Clone and install this extension.
   ```
   cd /usr/local/apnscp
   mkdir -p extensions
   git clone https://github.com/thundersquared/apiscp-betteruptime.git extensions/apiscp-betteruptime
   cd extensions/apiscp-betteruptime
   composer install
   ```

2. Set your status page URL, key and page ID.
   ```
   cpcmd scope:set cp.config misc sys_status 'https://status.domain.com/'
   cpcmd scope:set cp.config extensions betteruptime_status_page 123
   cpcmd scope:set cp.config extensions betteruptime_api_key abc123
   ```
3. Wait for Apache to reload and check out your panel.