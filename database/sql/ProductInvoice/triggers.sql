CREATE OR REPLACE TRIGGER trigger_insert_input_or_output_products
AFTER UPDATE ON product_invoices
FOR EACH ROW
WHEN (OLD.status IS DISTINCT FROM NEW.status)
EXECUTE FUNCTION insert_input_or_output_product_when_product_invoice_approve();
