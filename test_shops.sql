-- Insert test shops with coordinates for location search testing
-- Test location: New York City (40.7128, -74.0060)

INSERT INTO owner_shops (owner_id, name, address, phone_no, start_time, end_time, service_type, status, lat, lng, created_at, updated_at) VALUES
(1, 'Downtown Car Wash NYC', '123 Broadway, New York, NY 10007', '+1-212-555-0001', '08:00:00', '18:00:00', 0, 1, '40.7138', '-74.0070', datetime('now'), datetime('now')),
(1, 'Midtown Auto Detailing', '456 5th Avenue, New York, NY 10018', '+1-212-555-0002', '07:00:00', '19:00:00', 0, 1, '40.7549', '-73.9840', datetime('now'), datetime('now')),
(1, 'Brooklyn Premium Wash', '789 Atlantic Ave, Brooklyn, NY 11217', '+1-718-555-0003', '09:00:00', '20:00:00', 0, 1, '40.6838', '-73.9761', datetime('now'), datetime('now')),
(1, 'Queens Express Detailing', '321 Queens Blvd, Queens, NY 11373', '+1-718-555-0004', '08:00:00', '17:00:00', 0, 1, '40.7389', '-73.8785', datetime('now'), datetime('now')),
(1, 'Far Away Car Care', 'Far Location, NY', '+1-555-555-0005', '08:00:00', '18:00:00', 0, 1, '41.0000', '-74.5000', datetime('now'), datetime('now'));
